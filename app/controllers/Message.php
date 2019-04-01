<?php

class Message extends Controller{

    private $message;

    public function __construct() {
        $this->message = $this->getModel('Messages');
    }

    public function save() {
        if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)){
    
            $this->message->insert(array(
                'type' => $_POST['type'],
                'text' => $_POST['text']
            ));
    
        }
        redirect('message/index');
    }

    public function update($id) {
        if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)){
            
            $this->message->update(
                array( 'type' => $_POST['type'], 'text' => $_POST['text'] ),
                array( 'id' => $id )
            );
    
        }
        redirect('message/index');
    }

    public function delete($id) {
        $this->message->delete($id); 
        redirect('message/index');  
    }

    public function edit($id) {
        $this->setTitle('Update Message');
        $message = $this->message->one($id);
        if($message) {
            $this->view('message/index', array( 'message' => $message, 'messages' => $this->getMessages() )); 
        }
        redirect('message/index');
    }
    public function index() {
        $this->setTitle('Dash Message');
        $this->view('message/index', array( 'messages' => $this->getMessages() )); 
    }

    private function getMessages() {
        return $this->message->all();
    }
}