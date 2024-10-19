<div class="flex justify-center mt-4">
    @foreach($user->getGithubLanguages() as $language_name)
        <span class="bg-[#{{getLanguageColor($language_name)}}50] text-gray-200 text-xs px-2 py-1 rounded-full mx-1">{{$language_name}}</span>
    @endforeach
</div>
