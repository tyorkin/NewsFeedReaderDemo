<!DOCTYPE html>
<html>
    <head>
        <title>News Feed Reader</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            html, body {
                font-family: Verdana, arial, sans-serif;
                font-size: 16px;
                margin: 0;
                padding: 0;
            }
            .wrapper {                
                max-width: 960px;
                min-width: 310px;
                padding: 5px 0;
                margin: 0 auto;
            }
            select, input[type="text"], input[type="button"] {
                width: 100%;
                padding: 5px;
                box-sizing: border-box;
            }
            
            img {
                max-width: 100%;
            }
            
            .form-wrap {
                text-align: center;
                margin-bottom: 20px;
                border-bottom: 1px solid #cecece;
                padding: 10px 0 15px 0;
            }
            .form-control {
                width: 19%;
                display: inline-block;
            }  
            .list {
                padding: 0 10px;
            }
            .list .item {
                padding: 20px 10px;
                border-top: 1px solid #cecece;
            }          
            .list .item:first-child {
                border-top: none;
            }
            .list .item .name,
            .list .item .name a {
                font-weight: bold;
                font-size: 10px;
                color: #000;
            }
            .list .item .title {
                font-weight: bold;
                color: #000;
            }
            .list .item .date {                
                color: #cecece;
                font-size: 10px;
                text-align: right;
                padding-bottom: 5px;
            }

            .processing {
                opacity: 0.1;
                z-index: 99;
                -webkit-transition: all 0.5s ease-in;
                transition: all 0.5s ease-in;
            }
        </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="/js/home.js"></script>
    </head>                                                                   
    <body>
        <div class="wrapper">
            <div class="form-wrap">                
                <form id="form" name="form">
                    <div class="form-control">
                        <select id="provider" name="provider">
                            <option value="">Select news provider</option>
                            <option value="1">Twitter</option>
                        </select>
                    </div>
                    <div class="form-control">
                        <input type="text" id="interval" name="interval" placeholder="Enter refreshing interval in seconds" value="5">
                    </div>
                    <div class="form-control">
                        <input type="text" id="username" name="username" placeholder="Enter username" value="netpeak_ru">
                    </div>
                    <div class="form-control">
                        <input type="button" id="submit" name="submit" value="Run">                
                    </div>
                    <div class="form-control">
                        <input type="button" id="stop" name="stop" value="Stop">                
                    </div>
                </form>
            </div>
            <div class="content">
                <div class="item" style="display: none;" id="item_template">
                    <div class="name"></div>
                    <div class="title"></div>
                    <div class="date"></div>
                    <div class="description"></div>
                    <div class="media"></div>
                </div>
                <div class="list">

                </div>
            </div>
        </div>
    </body>
</html>