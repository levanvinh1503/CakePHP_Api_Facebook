<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
$cakeDescription = 'Demo CakePHP';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->Html->css('style.css') ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <!-- Header -->
    <div class="container-fluid">
        <!-- Row -->
        <div class="row">
            <!-- Content left -->
            <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
                <!-- Profile sidebar -->
                <div class="profile-sidebar">
                    <div class="profile-usertitle">
                        <div class="profile-usertitle-name"><?= $Auth->user('name')?></div>
                        <div class="profile-usertitle-status">
                            <span class="indicator label-success"></span>Online
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <!-- End profile sidebar -->
                <div class="divider"></div>
                <!-- Menu doashboard -->
                <ul class="nav menu">
                    <li>
                        <?= $this->Html->link('<em class="fa fa-home"></em> Dashboard</a>', [
                            'controller' => 'AccountSocial',
                            'action' => 'dashBoard',
                            'id' => $Auth->user('id')
                        ], [
                            'id' => 'flip-category',
                            'escape' => false
                        ])?>
                    </li>
                    <li class="">
                        <?= $this->Html->link('<em class="fa fa-bars"></em> List friend', [
                            'controller' => 'AccountSocial',
                            'action' => 'listFriend',
                            'id' => $Auth->user('id')
                        ], [
                            'id' => 'flip-category',
                            'escape' => false
                        ])?>
                    </li>
                    <li class="">
                        <?= $this->Html->link('<em class="fa fa-bars"></em> List bài đăng', [
                            'controller' => 'AccountSocial',
                            'action' => 'listPost',
                            'id' => $Auth->user('id')
                        ], [
                            'id' => 'flip-category',
                            'escape' => false
                        ])?>
                    </li>
                </ul>
                <!-- End menu doashboard -->
            </div>
            <!-- End content left -->
            <!-- Content right -->
            <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main content-left">
                <!-- Row -->
                <div class="row admin-header">
                    <h2><em class="fa fa-home"></em> Dashboard</h2>
                </div>
                <!-- End row -->
                <!-- Content -->
                <?= $this->fetch('content') ?>
                <!-- End content -->
            </div>
            <!-- End content right -->
        </div>
        <!-- End row -->
    </div>
    <!-- End header -->
    <?= $this->Html->script('jquery.js')?>
    <?= $this->Html->script('jquery.min.js')?>
    <?= $this->Html->script('bootstrap.min.js')?>
    <?= $this->Html->script('jquery.dataTables.min.js')?>
    <?= $this->Html->script('slug.js')?>
    <?= $this->Html->script('ckeditor/ckeditor')?>
    <script type="text/javascript">
        $(document).ready(function () {

        });
    </script>
</body>
</html>
