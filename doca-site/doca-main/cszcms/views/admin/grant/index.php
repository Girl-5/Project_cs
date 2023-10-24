<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li class="active">
                <i><span class="glyphicon glyphicon-user"></span></i> <?php echo  $this->lang->line('grant') ?>
            </li>
        </ol>
    </div>
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="h2 sub-header"><?php echo  $this->lang->line('grant_all') ?> <a role="button" href="<?php echo $this->Csz_model->base_link()?>/admin/grant/new" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-plus"></span> <?php echo  $this->lang->line('grant_addnew') ?></a></div>
        <form action="<?php echo $this->Csz_model->base_link(). '/admin/grant/'; ?>" method="get">
            <div class="control-group">
                <label class="control-label" for="search"><?php echo $this->lang->line('search'); ?>: <input type="text" name="search" id="search" class="form-control-static" value="<?php echo $this->input->get('search');?>"></label> &nbsp;&nbsp;&nbsp;                 
                <input type="submit" name="submit" id="submit" class="btn btn-default" value="<?php echo $this->lang->line('search'); ?>">
            </div>
        </form>
        <br><br>
        <div class="box box-body table-responsive no-padding">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th width="10%" class="text-center"><?php echo "No"; ?></th>
                        <th width="10%" class="text-center"><?php echo $this->lang->line('user_status'); ?></th>
                        <th width="20%" class="text-center">Grant Name</th>
                        <th width="30%" class="text-center">Description</th>
                        <th width="25%"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($grant === FALSE) { ?>
                        <tr>
                            <td colspan="5" class="text-center"><span class="h6 error"><?php echo  $this->lang->line('data_notfound') ?></span></td>
                        </tr>                           
                    <?php } else { ?>
                        <?php
                        $id=0;
                        foreach ($grant as $u) {
                            $id=++$id;
                            if(!$u['active']){
                                $inactive = ' style="vertical-align: middle;color:red;text-decoration:line-through;"';
                                $status = '<span style="color:red;">Deactivated</span>';
                            }else{
                                $inactive = '';
                                $status = '<span style="color:green;">Activated</span>';
                            }
                           
                            echo '<tr>';
                            echo '<td class="text-center" style="vertical-align: middle;">' . $id . '</td>';
                            echo '<td class="text-center" style="vertical-align: middle;">' . $status . '</td>';
                            echo '<td'.$inactive.' class="text-center" style="vertical-align: middle;">' . $u['title']. '</td>';
                            echo '<td'.$inactive.' class="text-center" style="vertical-align: middle;">' . $u['description'] . '</td>';
                            echo '<td class="text-center" style="vertical-align: middle;"><a href="'.$this->Csz_model->base_link().'/admin/grant/edit/' . $u['id'] . '" class="btn btn-default btn-sm" role="button"><i class="glyphicon glyphicon-pencil"></i> '.$this->lang->line('user_edit_btn').'</a> &nbsp;&nbsp; <a role="button" class="btn btn-danger btn-sm" role="button" onclick="return confirm(\''.$this->lang->line('user_delete_message').'\')" href="'.$this->Csz_model->base_link().'/admin/grant/delete/'.$u['id'].'"><i class="glyphicon glyphicon-remove"></i> '.$this->lang->line('user_delete_btn').'</a></td>';
                            echo '</tr>';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?php echo $this->pagination->create_links(); ?> <b><?php echo $this->lang->line('total').' '.$total_row.' '.$this->lang->line('records');?></b>
        <!-- /widget-content --> 
        <br><br>
        <span class="warning">
            <i class="glyphicon glyphicon-lock"></i> <?php echo  $this->lang->line('default_data_remark') ?>
        </span>
    </div>
</div>
