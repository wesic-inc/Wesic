<?php

class CommentRepository extends Basesql
{

    /**
     * Choose the correct form based on the settings
     * @return mixed
     */
    public static function selectSuitableForm()
    {
        if (setting('comments') == 1) {
            return Comment::getFormNewConnectedCommment();
        } elseif (setting('comments') == 2) {
            if (Auth::isConnected()) {
                return Comment::getFormNewConnectedCommment();
            } else {
                return Comment::getFormNewCommment();
            }
        }
        return false;
    }

    /**
     * Create comment from data
     * @param  array $data
     * @return bool
     */
    public static function newComment($data)
    {
        $comment = new Comment();

        $comment->setBody($data['body']);
        $comment->setCreatedAt();
        $comment->setStatus(2);
        $comment->setPostId($data['idpost']);

        if (isset($data['email'])) {
            $comment->setEmail($data['email']);
            $comment->setName($data['name']);
            $comment->setType(2);
        } else {
            $comment->setUserId(Auth::id());
            $comment->setType(1);
        }
        $comment->save();
        return true;
    }

    /**
     * Switch the status of one comment based on id
     * @param integer $id     the comment id
     * @param integer $status the status code
     * @return  bool
     */
    public static function setCommentStatus($id, $status)
    {
        if ($status == 1 || $status == 2 || $status == 3 || $status == 4 || $status == 5) {
            $comment = new Comment();
            $comment->setStatus($status);
            $comment->setId($id);
            $comment->save();
            return true;
        } else {
            return false;
        }
    }
}
