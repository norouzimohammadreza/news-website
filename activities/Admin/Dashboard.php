<?php 
namespace Admin;
use database\DataBase;
class  Dashboard{
    function index(){
        $db = new DataBase;
        //----------------------------------------------------------------------
        
        $catCount = $db->select('SELECT COUNT(*) FROM categories')->fetchAll();
        $userCount = $db->select('SELECT COUNT(*) FROM users WHERE is_admin = ?',[0])->fetchAll();
        $adminCount = $db->select('SELECT COUNT(*) FROM users WHERE is_admin = ?',[1])->fetchAll();
        $postCount = $db->select('SELECT COUNT(*) FROM posts')->fetchAll();
        $commentCount = $db->select('SELECT COUNT(*) FROM comments')->fetchAll();
        $viewOfPost = $db->select('SELECT COUNT(view) FROM posts')->fetchAll();
        $approvedComment = $db->select('SELECT COUNT(*) FROM comments WHERE status = "approved"')->fetchAll();
        $unseenComment = $db->select('SELECT COUNT(*) FROM comments WHERE status = "unseen"')->fetchAll();

        //----------------------------------------------------------------------
        $postsForView = $db->select('SELECT * FROM posts ORDER BY view DESC LIMIT 0,3')->fetchAll();
        //$commentPerPost = $db->select('SELECT comments.*, COUNT(comments.id)')->fetchAll();
        $mostCommentedPosts = $db->select('SELECT posts.id, posts.title, COUNT(comments.post_id) AS comment_count 
            FROM posts LEFT JOIN comments ON posts.id = comments.post_id 
            GROUP BY posts.id ORDER BY comment_count DESC LIMIT 0,3')->fetchAll();
        $commentForUsername = $db->select('SELECT comments.* , users.username FROM comments LEFT JOIN 
        users ON comments.user_id = users.id ORDER BY comments.created_time DESC LIMIT 0,3')->fetchAll();
    
        //----------------------------------------------------------------------
        require_once((BASE_PATH) . '/template/admin/index.php');
    }
}