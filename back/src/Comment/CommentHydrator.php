<?php

namespace Comment;

class CommentHydrator
{
    public function extract(Comment $comment): array
    {
        $data = [];

        if ($comment->getId()) {
            $data['id'] = $comment->getId();
        }
        if ($comment->getIdBar()) {
            $data['idBar'] = $comment->getIdBar();
        }
        if($comment->getIdUser())
        {
            $data['iduser'] = $comment->getIdUser();
        }
        if ($comment->getContent()) {
            $data['content'] = $comment->getContent();
        }
        if ($comment->getDate()) {
            $data['dateCom'] = $comment->getDate();
        }
        if ($comment->getUserName()) {
            $data['nameuser'] = $comment->getUserName();
        }
        return $data;
    }

    public function extractAll($comments)
    {
        $data = [];
        foreach ($comments as $comment) {
            $data[] = $this->extract($comment);
        }
        return $data;
    }
}

