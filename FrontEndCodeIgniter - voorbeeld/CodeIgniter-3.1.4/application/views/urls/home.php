<html>
    <head>
        <title>WP2</title>
    </head>
    <body>
    <?php echo form_open('personeelcontroller/editPersoon'); ?>
<select name="id">
    <?php foreach ($personeel as $pers){
        echo '<option value="'.$pers['personeel_Id'].'"">'.$pers['personeel_naam'].'</option>';
    }
    ?>
</select>
<input type="text" width="100" name="name"/>
<input type="submit" name="submit" value="update" />
    <table>
        <?php
        foreach ($personeel as $pers){
            echo '<tr>';
            echo '<td>' . $pers['personeel_naam'] . '          ' .'</td>';
            echo '</tr>';
        }
        ?>
    </table>
</form>
</body>
</html>