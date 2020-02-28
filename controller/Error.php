<?php
/**
 * Created by IntelliJ IDEA.
 * User: yustas
 * Date: 2/26/20
 * Time: 7:54 PM
 */

namespace controller;

use system\BaseController;

class Error extends BaseController
{
    public function show($param = null)
    {
        $errorMessage = isset($_SESSION['error']) ? $_SESSION['error'] : 'Вероятно, страница отсутствует.';
        echo $this->twigInstance->render('errorShow.twig', ['error' => $errorMessage]);
    }
}