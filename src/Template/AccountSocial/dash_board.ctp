<div class="container-fluid">
    <div class="row">
        <h2 class="title-dashborad">Dashboard</h2>
        <div class="col-lg-4 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-8">
                            <i class="fa fa-edit fa-5x"> <?= $postSocial ?></i>
                        </div>
                        <div class="col-xs-4 text-right">
                            <div class="huge"></div>
                            <div>Bài đăng!</div>
                        </div>
                    </div>
                </div>
                <?= $this->Html->link('
                    <div class="panel-footer">
                    <span class="pull-left">Xem chi tiết</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                    </div>', [
                        'controller' => 'AccountSocial',
                        'action' => 'listFriend',
                        'id' => $idAccount
                    ], [
                        'escape' => false
                    ]);
                    ?>
                </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-8">
                            <i class="fa fa-users fa-5x"> <?= $friendSocial ?></i>
                        </div>
                        <div class="col-xs-4 text-right">
                            <div class="huge"></div>
                            <div>Bạn bè!</div>
                        </div>
                    </div>
                </div>
                <?= $this->Html->link('<div class="panel-footer">
                    <span class="pull-left">Xem chi tiết</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                    </div>', [
                        'controller' => 'AccountSocial',
                        'action' => 'listFriend',
                        'id' => $idAccount
                    ], [
                        'escape' => false
                    ]);
                    ?>
            </div>
        </div>
    </div>
</div>
