<section id="hero" class="bg-cover bg-center bg-no-repeat p-[100px] w-[100vw] h-[100vh] flex flex-col items-center justify-center"
         style="background-image: url('{{asset('/assets/images/hero-bg.svg')}}');">
    <div class="flex flex-col items-center justify-center">
        <a href="{{$user->html_url}}" target="_blank">
            <img class="rounded-full w-32 h-32" src="{{getAvatar($user)}}" alt="{{$user->name}}">
        </a>
        <p class="text-center mt-4 text-gray-500">
                <span wire:poll.5s.keep-alive.visible="$dispatch('magic-word-pool-refresh')" wire:transition.fade
                      class="font-bold text-gray-300 transition delay-100 duration-100 ease-in">
                    {{$magic_word}}
                </span>
            Meu nome é <span class="text-[#E3646E]">{{$user->name}}</span> e sou
        </p>
    </div>
    <h1 class="text-4xl text-center mt-4 font-bold text-white">
        {{$title}}
    </h1>
    <p class="text-center mt-4 text-gray-500">
        {{$phrase}}
    </p>
    <div class="flex justify-center mt-4">
        @livewire('components.sections.hero-section.language-badges', ['user' => $user])
    </div>
</section>
