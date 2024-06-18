<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>New message</title>
</head>

<body>
    <h1>You received a new message</h1>
    <section>
        <div id="div-img">
            <div class="container-fluid p-2">
                <p>Name: <span>{{$lead['name']}}</span></p>
                <p>Mail: <span>{{$lead['email']}}</span></p>
            </div>
        </div>
    </section>
    <section>
        <div class="container mt-2">
            <p class="border-1 rounded-2"><b>Content: </b>{{$lead['message']}}</p>
        </div>
    </section>
</body>

<style>
    div#div-img {
        height: 150px;
        background-image: url('https://th.bing.com/th/id/OIP.S8fISDPMl1FytnW18RWWCQHaGL?w=960&h=800&rs=1&pid=ImgDetMain');
        background-image: no-repeat;
        background-image: cover;

        & p {
            margin: .5rem auto;
            color: white;

            >span {
                color: red;
                font-weight: 400;
                font-family: 'Times New Roman', Times, serif;
                background-color: rgba(255, 255, 255, 0.241);
            }
        }
    }
</style>

</html>