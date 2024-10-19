<a class="bg-[#292C34] p-4 rounded-lg shadow-lg flex flex-row items-center" href="{{$project->link}}">
    <img
        src="{{asset("/assets/images/projects/$project->image")}}"
        alt="{{$project->name}}"
        class="bg-[#16181D] w-[150px] h-[80%] object-cover rounded-lg shadow-lg"
    >
    <div class="w-[50%] ml-4 text-left">
        <h3 class="text-white text-lg font-bold mt-4">
            {{$project->name}}
        </h3>
        <p class="text-gray-500 mt-2">
            {{$project->description}}
        </p>
        <div class="flex justify-center mt-2 w-full flex-wrap">
            @foreach($project->tags as $language_name)
                <span class="bg-[#{{getLanguageColor($language_name)}}50] text-gray-200 text-xs px-2 py-1 rounded-full mx-1">{{$language_name}}</span>
            @endforeach
        </div>
    </div>
</a>
