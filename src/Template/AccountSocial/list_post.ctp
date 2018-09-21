<div class="list-category-admin">
    <h2 class="title-dashborad">Danh sách bạn bè</h2>
    <?= $this->Flash->render('delete-category')?>
    <div class="search-block">
        <?= $this->Form->create('search', ['id' => 'form-search', 'url' => ['controller' => 'AccountSocial', 'action' => 'listPost']]);?>
        <?= $this->Form->input('search', ['value' => $keySearch])?>
        <?= $this->Form->button('<i class="fa fa-search"></i>', ['class' => 'btn-search', 'escape' => false])?>
        <?= $this->Form->end()?>
    </div>
    <!-- Table Category -->
    <table class="table table-striped table-bordered table-hover" id="table-list-category">
        <thead>
            <tr>
                <th style="width: 20%"><?= $this->Paginator->sort('id', $this->Html->image('sort_both.png'), ['escape' => false])?>ID Post</th>
                <th style="width: 50%"><?= $this->Paginator->sort('message', $this->Html->image('sort_both.png'), ['escape' => false])?>Nội dung</th>
                <th style="width: 30%"><?= $this->Paginator->sort('created_at', $this->Html->image('sort_both.png'), ['escape' => false])?>Ngày tạo</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if (count($arrayPost) > 0) {
                foreach ($arrayPost as $keyPost => $valuePost) {
                    ?>
                    <tr>
                        <td>
                            <?php 
                            $idAccount = explode('_', $valuePost->id);
                            echo $idAccount[1];
                            ?>
                        </td>
                        <td><?= h($valuePost->message) ?></td>
                        <td><?= $valuePost->created_at ?></td>
                    </tr>
                    <?php 
                }
            } else {
                ?>
                <tr>
                    <td colspan="7" style="text-align: center;">Không có dữ liệu</td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
    <?php if (count($arrayPost) > 0) { ?>
        <div class="pagination-block">
            <ul class="pagination-list">
                <?php 
                if (!empty($this->Paginator->numbers())) {
                    echo $this->Paginator->prev('<i class="fa fa-caret-left"></i>', ['escape' => false], null, ['class' => 'prev disabled']);
                }
                echo $this->Paginator->numbers();
                if (!empty($this->Paginator->numbers())) {
                    echo $this->Paginator->next('<i class="fa fa-caret-right"></i>', ['escape' => false], null, ['class' => 'next disabled']);
                }
                ?>
            </ul>
        </div>
    <?php }?>
    <!-- End table Category -->
</div>
<!-- End block list category -->
