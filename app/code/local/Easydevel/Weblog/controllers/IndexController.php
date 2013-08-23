<?php
class Easydevel_Weblog_IndexController extends Mage_Core_Controller_Front_Action {

	public function testModelAction() {
		/*
		echo 'Setup!';
        $blogpost = Mage::getModel('weblog/blogpost');
        echo get_class($blogpost);
        */
		
		
	    $params = $this->getRequest()->getParams();
	    
	    $blogpost = Mage::getModel('weblog/blogpost');
	    
	    echo("Loading the blogpost with an ID of ".$params['id']);
		echo ("->".get_class($blogpost)."<-");
	    $blogpost->load($params['id']);
	    
	    $data = $blogpost->getData();
	    var_dump($data);
	    $data = $blogpost->getOrigData('title');
	    var_dump($data);
	    $data= $blogpost->getTitle();
	    var_dump($data);
	   
    }
	public function createNewPostAction() {
	    $blogpost = Mage::getModel('weblog/blogpost');
	    $blogpost->setTitle('Code Post!');
	    $blogpost->setPost('This post was created from code!');
	    $blogpost->save();
	    echo 'post with ID ' . $blogpost->getId() . ' created';
	}
	public function editFirstPostAction() {
	    $blogpost = Mage::getModel('weblog/blogpost');
	    $blogpost->load(1);
	    $blogpost->setTitle("The First post!");
	    $blogpost->save();
	    echo 'post edited';
	}
	public function deleteFirstPostAction() {
	    $blogpost = Mage::getModel('weblog/blogpost');
	    $blogpost->load(1);
	    $blogpost->delete();
	    echo 'post removed';
	}
	public function showAllBlogPostsAction() {
	    $posts = Mage::getModel('weblog/blogpost')->getCollection();
	    foreach($posts as $blogpost){
	        echo '<h3>'.$blogpost->getTitle().'</h3>';
	        echo nl2br($blogpost->getPost());
	    }
	}
}