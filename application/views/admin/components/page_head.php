<!DOCTYPE html>
<html>
    <head>
        <?php // echo site_url(); ?>
        <title><?php echo $meta_title; ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo site_url('public_html/css/datepicker.css')?>">
        <link rel="stylesheet" href="<?php echo site_url('public_html/css/admin.css')?>">
        <link rel="stylesheet" href="<?php echo site_url('public_html/css/style.css')?>">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="http://code.jquery.com/jquery-latest.js"></script>
        <script src="<?php echo site_url('public_html/js/bootstrap-datepicker.js')?>"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
        <?php if (isset($sortable) && $sortable === TRUE): ?>
            <script type="text/javascript" src="<?php echo site_url('public_html/js/jquery-ui-1.9.2.custom.min.js'); ?>"></script>
            <script type="text/javascript" src="<?php echo site_url('public_html/js/jquery.mjs.nestedSortable.js'); ?>"></script>
        <?php endif; ?>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- TinyMCE -->
        <script type="text/javascript" src="<?php echo site_url('public_html/js/tiny_mce/tiny_mce.js'); ?>"></script>
        <script type="text/javascript">
            tinyMCE.init({
                // General options
                mode: "textareas",
                theme: "advanced",
                plugins: "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks",
                // Theme options
                theme_advanced_buttons1: "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
                theme_advanced_buttons2: "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
                theme_advanced_buttons3: "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
                theme_advanced_buttons4: "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft,visualblocks",
                theme_advanced_toolbar_location: "top",
                theme_advanced_toolbar_align: "left",
                theme_advanced_statusbar_location: "bottom",
                theme_advanced_resizing: true,
            });
        </script>
        <!-- /TinyMCE -->

    </head>