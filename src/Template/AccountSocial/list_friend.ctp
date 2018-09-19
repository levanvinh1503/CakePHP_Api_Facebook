<div class="list-category-admin">
    <h2 class="title-dashborad">Danh sách bạn bè</h2>
    <?= $this->Flash->render('delete-category')?>
    
    <table class="table table-striped table-bordered table-hover" id="table-list-category">
        <thead>
            <tr>
                <th style="width: 40%">ID Friend</th>
                <th style="width: 60%">Tên Friend</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if (count($arrayFriend) > 0) {
                foreach ($arrayFriend as $keyFriend => $valueFriend) {
                    ?>
                    <tr>
                        <td>
                            <?php 
                            $idAccount = explode('_', $valueFriend->id);
                            echo $idAccount[0];
                            ?>
                        </td>
                        <td><?= h($valueFriend->name_friend) ?></td>
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
    <?php if (count($arrayFriend) > 0) { ?>
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
