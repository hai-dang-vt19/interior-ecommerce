<html>
    <head>
        <style>
            .nody_sendmail{
                text-align: center;
                height: 100%;
                padding-top: 5px;
                padding-bottom: 5px;
                width: 90%;
            }
            .nody_sendmail h2{
                color: #f3be36;
                font-size: 30px;
                font-style: italic;
                padding-bottom: 5px;
            }
            .nody_des h3{
                text-align: start;
                margin-left: 10%;
                color: rgb(148, 148, 148);
                max-width: 80%;
            }
        </style>
    </head>
    <body>
        <div class="nody_sendmail">
            <h2>Khách: 
                {{ $data['name'] }} , {{$data['phone']}}
            </h2>
            <div class="nody_des">
                <h3>
                    Nội dung: {{ $data['title'] }}<br>
                    <span style="margin-left: 5%">
                        {{ $data['content'] }}    
                    </span>
                </h3>
            </div>
        </div>
    </body>
</html>