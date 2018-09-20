<div class="" style="padding: 10px 0;">
    <div class="col-md-3 col-lg-3 " align="center">
        <img style="border-radius: 50%; border: 1px solid #c0c0c0; padding: 2px;" src="<?= $getUserInfo['picture']['url']?>" />
        <h4 style="margin-top: 20px;"><?= $getUserInfo['name']?></h4>
    </div>
    <div class=" col-md-9 col-lg-9 "> 
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#infomation">Thông tin</a></li>
            <li><a data-toggle="tab" href="#photoupload">Hình ảnh upload</a></li>
            <li><a data-toggle="tab" href="#phototagged">Hình ảnh gắn thẻ</a></li>
        </ul>
        <div class="tab-content">
            <div id="infomation" class="tab-pane fade in active">
                <table class="table table-user-information">
                    <tbody>
                        <tr>
                            <td>Name:</td>
                            <td><?= $getUserInfo['name']?></td>
                        </tr>
                        <tr>
                            <td>Birthday:</td>
                            <td>
                                <?php
                                //Convert object to array
                                $objToArray = get_object_vars($getUserInfo['birthday']);
                                //Get datetime
                                $birthDay = $objToArray['date'];
                                if (isset($birthDay)) {
                                    $dateTime = explode(' ', $birthDay);
                                    echo $dateTime[0];
                                } else {
                                    echo "Không có quyền !";
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <tr>
                                <td>Sex:</td>
                                <td>
                                    <?php 
                                    if (isset($getUserInfo['gender'])) {
                                        echo $getUserInfo['gender'];
                                    } else {
                                        echo "Không có quyền !";
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Email:</td>
                                <td>
                                    <?php 
                                    if (isset($getUserInfo['email'])) {
                                        echo $getUserInfo['email'];
                                    } else {
                                        echo "Không có quyền hoặc email không hợp lệ hoặc email chưa được xác nhận. !";
                                    }
                                    ?>
                                </td>
                            </tr>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div id="photoupload" class="tab-pane fade in" style="padding: 10px 0">
                
            </div>
            <div id="phototagged" class="tab-pane fade in" style="padding: 10px 0">
                
            </div>
        </div>
    </div>
</div>
