<?php
/**
 * Created by PhpStorm.
 * User: bingtao
 * Date: 2015/12/5
 * Time: 23:42
 */

$config=array();
$config['img_dir']="/upload/article_img";  // public is included in STATIC_PATH

class Admin extends MY_Controller
{
    var $db;
    var $article;
    var $media;
    var $type;
    var $user;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('mod_user', 'user');
        $this->user->init($this->db);
        $this->load->model('mod_article', 'article');
        $this->article->init($this->db);
        $this->load->model('mod_type', 'type');
        $this->type->init($this->db);
        $this->load->model('mod_media', 'media');
        $this->media->init($this->db);
    }

    public function index($error_id=null){
        $articles = $this->article->get_all_article();
        $media = $this->media->get_all_media();
        $type = $this->type->get_all_type();
        $data = [
            'articles' => $articles,
            'media'    => $media,
            'type'     => $type,
        ];
        if ($error_id) {
            $data['error_id'] = $error_id;
        }
        $this->load->view('admin_view', $data);
    }
}
