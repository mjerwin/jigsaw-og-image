<html>
<head>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background: url('https://www.toptal.com/designers/subtlepatterns/patterns/what-the-hex.png');
        }
    </style>
</head>
<body>
<div style="width: 800;height:600px;">
    <div class="flex h-screen bg-gray-500">
        <div class="m-auto">
            <div class="flex flex-col sm:flex-row justify-center">
                <img src="https://www.matthewerwin.co.uk/assets/img/portrait_2020.jpg" class="rounded-full w-1/3  m-auto sm:m-0">
                <div class="sm:ml-10 w-full sm:w-1/2 text-center sm:text-left">
                    <h1 class="text-4xl text-white">Matthew Erwin</h1>
                    <h1 class="text-2xl text-white">{{$page->title}}</h1>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>