<?php

use \Router\Router;
use \Token\JwtHS256;

$pdo = \Database\DatabaseSingleton::getInstance();
$commentValidator = new \Comment\CommentValidator();
$commentRepository = new \Comment\CommentRepository($pdo);
$barHydrator = new \Bar\BarHydrator();
$userRepository = new \User\UserRepository($pdo);
$barRepository = new \Bar\BarRepository($pdo);

Router::get('/api/bars\?keywords\=(.+)', function($request) use($barRepository, $barHydrator)
{
    $keywords = explode(',', rawurldecode($request->params[0]));
    $bars = $barRepository->fetchByKeyWords($keywords);

    if($bars == NULL) {
        http_response_code(404);
        echo json_encode(array('error' => 'No such bar with those keywords'));
        return;
    }

    echo json_encode($barHydrator->extractAll($bars), JSON_UNESCAPED_UNICODE);
});

Router::get('/api/bars/{}', function($request) use($barRepository, $barHydrator)
{
    $id = intval($request->params[0]);

    if (strval($id) !== $request->params[0]) {
    	http_response_code(400);
        echo json_encode(array('error' => 'Parameters are not correct.'));
        return;
    }

    $bar = $barRepository->fetchById($id);
    if ($bar == null) {
        http_response_code(404);
        echo json_encode(array('error' => 'No such bar with this id.'));
        return;
    }

    echo json_encode($barHydrator->extract($bar), JSON_UNESCAPED_UNICODE);
});

Router::post('/api/bars/{}/comments', function($request) use($barRepository, $commentValidator, $commentRepository) {

    if (!$commentValidator->validate($request->body)) {
        return http_response_code(400);
    }

    $comment = (new \Comment\Comment())
        ->setIdBar($request->body->idBar)
        ->setIdUser($request->body->idUser)
        ->setContent($request->body->content)
        ->setDate($request->body->dateCom);

    if(!$commentRepository->isSoloCom($comment)) {
        http_response_code(403);
        echo json_encode(['error' => 'Vous avez déjà posté un avis sur ce bar']);
        return;
    }

    if(!$commentRepository->createComment($comment)) {
        return http_response_code(500);
    } else {
        return http_response_code(201);
    }
});

Router::delete('/api/comments/{}', function($request) use($userRepository, $commentRepository) {
    if (!array_key_exists('HTTP_AUTHORIZATION', $_SERVER)) {
        http_response_code(401);
        echo json_encode(['error' => 'You are not authorized without JWT']);
        return;
    }

    [, $token] = explode(' ', $_SERVER['HTTP_AUTHORIZATION']);

    try {
        $userId = \Token\JwtHS256::validate($token, getenv('SECRET'));
        $user = $userRepository->fetchFullById($userId);
    } catch (Exception $e) {
        http_response_code(401);
        echo json_encode(['error' => $e->getMessage()]);
        return;
    }

    if(!(isset($request->params[0]))) return http_response_code(400);

    $str_comment_id = $request->params[0];
    $comment_id = ctype_digit($str_comment_id) ? intval($str_comment_id) : null;
    if ($comment_id == null)
    {
        return http_response_code(400);
    }
    if($commentRepository->deleteComment($comment_id))
        return http_response_code(200);
    else
        return http_response_code(500);

});
