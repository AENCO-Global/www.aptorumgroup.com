<?php
define('DATA_PATH', 'http://addressbook.edmund-wong.com/aptorumgroup/data.json');
define('COMPANY', 'Aptorum Group');

$json = file_get_contents(DATA_PATH);

$arr = json_decode($json, true);

$usernode = array();
foreach($arr['data']['users'] as $user){
    $usernode[] = array('text'=>$user['email'],'href'=>'mailto:'.$user['email']);
}

$groupnode = array();
foreach($arr['data']['groups'] as $groups){
    
    $groupmember = array();
    foreach($groups['members'] as $members){
        $groupmember[] = array('text'=>$members['email']);
    }
    $groupnode[] = array('text'=>$groups['name'],'href'=>'mailto:'.$groups['name'],'tags'=>array(sizeof($groupmember)),'nodes'=>$groupmember);
}

$data[] = array('text'=>'Users','state'=>array('expanded'=>false),'tags'=>array(sizeof($usernode)),'nodes'=>$usernode);
$data[] = array('text'=>'Groups','state'=>array('expanded'=>false),'tags'=>array(sizeof($groupnode)),'nodes'=>$groupnode);

?>
    <html>

    <head>
        <title>
            <? echo COMPANY; ?> Address Book</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
            crossorigin="anonymous">
        <!-- <link href="./css/bootstrap-treeview.css" rel="stylesheet"> -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="js/bootstrap-treeview.js"></script>
        <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">

    </head>

    <body>
        <div class="container">

            <div class="row">
                <div class="col-sm-12">
                    <h2>Address Book of
                        <?php echo COMPANY; ?>
                    </h2>
                    <div id="treeviewAddress" class=""></div>
                </div>
            </div>
        </div>
        <script>
            var Data = <?php  echo json_encode($data); ?>;


            $(document).ready(function () {
                $('#treeviewAddress').treeview({
                    color: "#428bca",
                    expandIcon: "glyphicon glyphicon-stop",
                    collapseIcon: "glyphicon glyphicon-unchecked",
                    nodeIcon: "glyphicon glyphicon-user",
                    showTags: true,
                    enableLinks: true,
                    data: Data
                });
            });
        </script>
    </body>

    </html>