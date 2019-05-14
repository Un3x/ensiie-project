<?php
require('includes/config.php');
$action   = $_POST['action'];
$postID   = $_POST['id'];
$memberID = $_SESSION['memberID'];
switch ($action) {
    case "upvote":
        try {
            $stmt = $db->prepare('SELECT memberID,postID,voteType FROM votes WHERE postID = :postID AND memberID =:memberID');
            $stmt->execute(array(
                ':postID' => $postID,
                ':memberID' => $memberID
            ));
            $row = $stmt->fetch();
            if ($row['voteType'] == "up") {
                $stmt = $db->prepare('DELETE FROM votes WHERE postID = :postID AND memberID =:memberID');
                $stmt->execute(array(
                    ':postID' => $postID,
                    ':memberID' => $memberID
                ));
                $stmt = $db->prepare('UPDATE posts SET upVote = upVote -1 WHERE postID = :postID');
                $stmt->execute(array(
                    ':postID' => $postID
                ));
            }

            else if ($row['voteType'] == "down") {
                $voteType = "up";
                $stmt     = $db->prepare('UPDATE votes SET voteType = :voteType WHERE postID = :postID AND memberID =:memberID');
                $stmt->execute(array(
                    ':voteType' => $voteType,
                    ':postID' => $postID,
                    ':memberID' => $memberID
                ));
                $stmt = $db->prepare('UPDATE posts SET upVote = upVote +1, downVote = downVote -1 WHERE postID = :postID');
                $stmt->execute(array(
                    ':postID' => $postID
                ));
            } else if ($row['memberID'] == null) {
                $voteType = "up";
                $stmt     = $db->prepare('INSERT INTO votes (postID,memberID,voteType) VALUES (:postID, :memberID, :voteType)');
                $stmt->execute(array(
                    ':postID' => $postID,
                    ':memberID' => $memberID,
                    ':voteType' => $voteType
                ));
                $stmt = $db->prepare('UPDATE posts SET upVote = upVote +1 WHERE postID = :postID');
                $stmt->execute(array(
                    ':postID' => $postID
                ));
            }
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
        break;
    case "downvote":
        try {
            $stmt = $db->prepare('SELECT memberID,postID,voteType FROM votes WHERE postID = :postID AND memberID =:memberID');
            $stmt->execute(array(
                ':postID' => $postID,
                ':memberID' => $memberID
            ));
            $row = $stmt->fetch();
            if ($row['voteType'] == "down") {
                $stmt = $db->prepare('DELETE FROM votes WHERE postID = :postID AND memberID =:memberID');
                $stmt->execute(array(
                    ':postID' => $postID,
                    ':memberID' => $memberID
                ));
                $stmt = $db->prepare('UPDATE posts SET downVote = downVote -1 WHERE postID = :postID');
                $stmt->execute(array(
                    ':postID' => $postID
                ));
            } else if ($row['voteType'] == "up") {
                $voteType = "down";
                $stmt     = $db->prepare('UPDATE votes SET voteType = :voteType WHERE postID = :postID AND memberID =:memberID');
                $stmt->execute(array(
                    ':voteType' => $voteType,
                    ':postID' => $postID,
                    ':memberID' => $memberID
                ));
                $stmt = $db->prepare('UPDATE posts SET downVote = downVote +1, upVote = upVote -1 WHERE postID = :postID');
                $stmt->execute(array(
                    ':postID' => $postID
                ));
            } else if ($row['memberID'] == null) {
                $voteType = "down";
                $stmt     = $db->prepare('INSERT INTO votes (postID,memberID,voteType) VALUES (:postID, :memberID, :voteType)');
                $stmt->execute(array(
                    ':postID' => $postID,
                    ':memberID' => $memberID,
                    ':voteType' => $voteType
                ));
                $stmt = $db->prepare('UPDATE posts SET downVote = downVote +1 WHERE postID = :postID');
                $stmt->execute(array(
                    ':postID' => $postID
                ));
            }
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
        break;
}
?> 