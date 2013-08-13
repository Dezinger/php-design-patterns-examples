<?php

interface DocManager {

    public function authenticate($user, $pwd);

    public function getDocuments($folderid);

    public function getDocumentsByType($folderid, $type);

    public function getFolders($folderid = null);

    public function saveDocument($document);
}


class Writely implements DocManager {

    public function authenticate($user, $pwd) {
        //authenticate using Writely authentication scheme
    }

    public function getDocuments($folderid) {
        //get documents available in a folder
    }

    public function getDocumentsByType($folderid, $type) {
        //get documents of specific type from a folder
    }

    public function getFolders($folderid = null) {
        //get all folders under a specific folder
    }

    public function saveDocument($document) {
        //save the document
    }
}


class GoogleDocs {

    public function authenticateByClientLogin() {
//authenticate using Writely authentication scheme
    }

    public function setUser() {
//set user 
    }

    public function setPassword() {
//set password
    }

    public function getAllDocuments() {
//get documents available in a folder
    }

    public function getRecentDocuments() {
        
    }

    public function getDocument() {
        
    }
}



Class GoogleDocsAdapter implements DocManager {

    private $GD;

    public function __construct() {
        $this->GD = new GoogleDocs();
    }

    public function authenticate($user, $pwd) {
        $this->GD->setUser($user);
        $this->GD->setPwd($pwd);
        $this->GD->authenticateByClientLogin();
    }

    public function getDocuments($folderid) {
        return $this->GD->getAllDocuments();
    }

    public function getDocumentsByType($folderid, $type) {
        //get documents using GoogleDocs object and return only
        // which match the type
    }

    public function getFolders($folderid = null) {
        //for example there is no folder in GoogleDocs, so
        //return anything.
    }

    public function saveDocument($document) {
        //save the document using GoogleDocs object
    }

}