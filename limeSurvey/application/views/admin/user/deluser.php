<<<<<<< HEAD
<div class='header'><?php $clang->eT("Delete user"); ?></div>
<div class='messagebox'>
    <form method="post" name="deluserform" action="<?php echo $this->createUrl("admin/user/deluser"); ?>">
        <?php $clang->eT("Transfer the surveys of this user to: "); ?>
        <select name='transfer_surveys_to'>
            <?php
                if (count($users) > 0)
                {
                    foreach ($users as $user)
                    {
                        $intUid = $user['uid'];
                        $sUsersName = $user['users_name'];
                        $selected = '';
                        if ($intUid == $current_user)
                            $selected = ' selected="selected"';

                        if ($postuserid != $intUid)
                        {
                        ?>
                        <option value="<?php echo $intUid; ?>" <?php echo $selected; ?>> <?php echo $sUsersName; ?></option>;
                        <?php
                        }

                    }
                }
            ?>
        </select>
        <input type="hidden" name="uid" value="<?php echo $postuserid; ?>" />
        <input type="hidden" name="user" value="<?php echo $postuser; ?>" />
        <input type="hidden" name="action" value="finaldeluser" /><br /> <br />
        <input type="submit" value="<?php $clang->eT("Delete User"); ?>" />
    </form>
=======
<div class='header'><?php $clang->eT("Delete user"); ?></div>
<div class='messagebox'>
    <form method="post" name="deluserform" action="<?php echo $this->createUrl("admin/user/deluser"); ?>">
        <?php $clang->eT("Transfer the surveys of this user to: "); ?>
        <select name='transfer_surveys_to'>
            <?php
                if (count($users) > 0)
                {
                    foreach ($users as $user)
                    {
                        $intUid = $user['uid'];
                        $sUsersName = $user['users_name'];
                        $selected = '';
                        if ($intUid == $current_user)
                            $selected = ' selected="selected"';

                        if ($postuserid != $intUid)
                        {
                        ?>
                        <option value="<?php echo $intUid; ?>" <?php echo $selected; ?>> <?php echo $sUsersName; ?></option>;
                        <?php
                        }

                    }
                }
            ?>
        </select>
        <input type="hidden" name="uid" value="<?php echo $postuserid; ?>" />
        <input type="hidden" name="user" value="<?php echo $postuser; ?>" />
        <input type="hidden" name="action" value="finaldeluser" /><br /> <br />
        <input type="submit" value="<?php $clang->eT("Delete User"); ?>" />
    </form>
>>>>>>> refs/remotes/origin/master
</div>