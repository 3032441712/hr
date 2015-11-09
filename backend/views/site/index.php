<?php
use app\models\HrNotice;
/* @var $this yii\web\View */

$this->title = '欢迎使用人力资源管理系统';
?>
<div class="site-index">

    <div class="jumbotron" style="display: none;">
        <h1>欢迎登录人力资源管理系统</h1>
        <p class="lead"></p>
        <p></p>
    </div>

    <div class="body-content">
        <div class="row" style="display: none;">
            <div class="col-lg-4">
                <h2></h2>
                <p></p>
                <p></p>
            </div>
        </div>
        <?php
            $notice = HrNotice::getLastNoticeArray();
            if (empty($notice)) {
                $notice = ['title' => '最新公告', 'content' => '暂未发表公告', 'created_at' => date('Y-m-d H:i:s')];
            }
        ?>
        <div class="row">
            <div class="col-md-4" style="width: 100%;">
                <!-- Info box -->
                <div class="box box-solid box-info">
                    <div class="box-header">
                        <h3 class="box-title"><?php echo $notice['title']?> &nbsp; <span style="font-size: 12px;"><?php echo $notice['created_at']?></span></h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-info btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-info btn-sm" style="display: none;" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body" style="font-size: 14px;">
                        <?php echo nl2br($notice['content'])?>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div>
        <div class="row">
            <div class="col-md-4" style="width: 100%;">
                <div class="box box-solid box-info">
                    <div class="box-header">
                        <h3 class="box-title">登录日志</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body no-padding">
                        <table class="table table-condensed">
                            <tbody>
                            <tr>
                                <th>登录IP</th>
                                <th style="width: 35%">登录时间</th>
                            </tr>
                            <?php foreach ($logArrayData as $item):?>
                            <tr>
                                <td><?php echo $item['ip_address']?></td>
                                <td><?php echo $item['created_at']?></td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                        </table>
                    </div><!-- /.box-body -->
                </div>
            </div>
        </div>
    </div>
</div>
