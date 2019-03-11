<?php
    $config=json_decode(file_get_contents("config.json"), true);
    function prep_file($name, $url, $icon)
    {
        $icon = is_null($icon)?substr($url, strrpos($url, '.')+1):$icon;
        return "
        <file class='mb-2'>
            <div>
                <img src='icon/$icon.svg' onerror='this.src=unknown_svg;'>
            </div>
            <div>
                <h5 class='mundb-text-truncate-1'>$name</h5>
                <p><a class='text-info' href='$url'>下载</a></p>
            </div>
        </file>
        ";
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?php echo $config["header"]; ?></title>
    <!-- Necessarily Declarations -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="alternate icon" type="image/png" href="favicon.png">
    <!-- Loading Style -->
    <style>
    loading > div{
        text-align: center;
    }
    loading p{
        font-weight:100;
    }
    loading{
        display:flex;
        z-index:999;
        position:fixed;
        top:0;
        bottom:0;
        right:0;
        left:0;
        justify-content:center;
        align-items:center;
        background: #f5f5f5;
        transition:.2s ease-out .0s;
        opacity:1;
    }

    .lds-ellipsis {
        display: inline-block;
        position: relative;
        width: 64px;
        height: 64px;
    }
    .lds-ellipsis div {
        position: absolute;
        top: 27px;
        width: 11px;
        height: 11px;
        border-radius: 50%;
        background: rgba(0,0,0,.54);
        animation-timing-function: cubic-bezier(0, 1, 1, 0);
    }
    .lds-ellipsis div:nth-child(1) {
        left: 6px;
        animation: lds-ellipsis1 0.6s infinite;
    }
    .lds-ellipsis div:nth-child(2) {
        left: 6px;
        animation: lds-ellipsis2 0.6s infinite;
    }
    .lds-ellipsis div:nth-child(3) {
        left: 26px;
        animation: lds-ellipsis2 0.6s infinite;
    }
    .lds-ellipsis div:nth-child(4) {
        left: 45px;
        animation: lds-ellipsis3 0.6s infinite;
    }
    @keyframes lds-ellipsis1 {
        0% {
            transform: scale(0);
        }
        100% {
            transform: scale(1);
        }
    }
    @keyframes lds-ellipsis3 {
        0% {
            transform: scale(1);
        }
        100% {
            transform: scale(0);
        }
    }
    @keyframes lds-ellipsis2 {
        0% {
            transform: translate(0, 0);
        }
        100% {
            transform: translate(19px, 0);
        }
    }
    </style>
</head>

<body>
    <!-- Loading -->
    <loading>
        <div>
            <div class="lds-ellipsis">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
            <p><?php echo $config["header"]; ?>疯狂加载中……</p>
        </div>
    </loading>
    <!-- Style -->
    <link rel="stylesheet" href="https://fonts.geekzu.org/css?family=Roboto:300,300i,400,400i,500,500i,700,700i">
    <link rel="stylesheet" href="https://cdn.mundb.xyz/css/bootstrap-material-design.min.css">
    <link rel="stylesheet" href="https://cdn.mundb.xyz/css/wemd-color-scheme.css">
    <link rel="stylesheet" href="https://cdn.mundb.xyz/css/atsast.css">
    <link rel="stylesheet" href="https://cdn.mundb.xyz/fonts/MDI-WXSS/MDI.css">
    <link rel="stylesheet" href="https://cdn.mundb.xyz/fonts/Devicon/devicon.css">
    <!-- Background -->
    <div class="mundb-background-container">
        <img src="<?php echo $config["background"]; ?>">
    </div>
    

    <style>
        .fs-title{
            color: #7a8e97;
            text-align:center;
            margin-bottom:1rem;
        }
        .fs-info{
            color: #7a8e97;
        }
        file{
            display: flex;
            align-items: center;
            max-width: 100%;
            box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 30px;
            border-radius: 4px;
            transition: .2s ease-out .0s;
            color: #7a8e97;
            background: #fff;
            padding: 1rem;
            position: relative;
            border: 1px solid rgba(0, 0, 0, 0.15);
        }

        file a:hover{
            text-decoration: none;
        }

        file:hover {
            box-shadow: rgba(0, 0, 0, 0.15) 0px 0px 40px;
        }

        file > div:first-of-type{
            display: flex;
            align-items: center;
            padding-right:1rem;
            width:5rem;
            height:5rem;
            flex-shrink: 0;
            flex-grow: 0;
        }

        file img{
            display: block;
            width:100%;
        }

        file > div:last-of-type{
            flex-shrink: 1;
            flex-grow: 1;
        }

        file p{
            margin:0;
        }
    </style>
    <div class="container mundb-standard-container">
        <div style="width:100%;">
            <h5 class="fs-title mb-3 mt-5"><?php echo $config["title"]; ?></h5>
            <p class="text-center mb-5 fs-info"><?php echo $config["subtitle"]; ?></p>
            <?php
                foreach ($config["file"] as $r) {
                    echo prep_file($r["name"], $r["url"], isset($r["icon"])?$r["icon"]:null);
                }
            ?>
        </div>
    </div>



    <script src="https://cdn.mundb.xyz/js/jquery-3.2.1.min.js"></script>
    <script src="https://cdn.mundb.xyz/js/popper.min.js"></script>
    <script src="https://cdn.mundb.xyz/js/snackbar.min.js"></script>
    <script src="https://cdn.mundb.xyz/js/bootstrap-material-design.js"></script>
    <script>
        var unknown_svg='data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 56 56" style="enable-background:new 0 0 56 56" xml:space="preserve"><g><path style="fill:%23e9e9e0" d="M36.985,0H7.963C7.155,0,6.5,0.655,6.5,1.926V55c0,0.345,0.655,1,1.463,1h40.074 c0.808,0,1.463-0.655,1.463-1V12.978c0-0.696-0.093-0.92-0.257-1.085L37.607,0.257C37.442,0.093,37.218,0,36.985,0z"/><polygon style="fill:%23d9d7ca" points="37.5,0.151 37.5,12 49.349,12"/><path style="fill:%23c8bdb8" d="M48.037,56H7.963C7.155,56,6.5,55.345,6.5,54.537V39h43v15.537C49.5,55.345,48.845,56,48.037,56z"/><circle style="fill:%23fff" cx="18.5" cy="47" r="3"/><circle style="fill:%23fff" cx="28.5" cy="47" r="3"/><circle style="fill:%23fff" cx="38.5" cy="47" r="3"/></g></svg>';
        $(document).ready(function () { $('body').bootstrapMaterialDesign(); });
        window.addEventListener("load",function() {
            $('loading').css({"opacity":"0","pointer-events":"none"});
        }, false);
    </script>
</body>

</html>