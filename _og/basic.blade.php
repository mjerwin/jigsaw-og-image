<html>
<head>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
<div style="width: 800px;height:300px;">
    <div class="flex h-screen bg-gray-800">
        <div class="m-auto">
            <div class="flex flex-col sm:flex-row justify-center">
                <img src="https://www.matthewerwin.co.uk/assets/img/portrait_2020.jpg" class="rounded-full w-1/3  m-auto sm:m-0">
                <div class="flex items-center justify-center sm:ml-10 w-full sm:w-1/2 text-center sm:text-left">
                    <div>
                        <h1 class="text-3xl text-white">{{$page->title}}</h1>
                        <h1 class="text-xl text-white mt-5">Matthew Erwin</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>