<section id="projects" class="bg-cover bg-center bg-no-repeat p-[100px] w-[100vw] h-full flex flex-col items-center"
         style="background-image: url('{{asset('/assets/images/hero-bg.svg')}}');">

    <div class="container mx-auto text-center mb-8">
        <h2 class="text-[#E3646E] text-3xl font-bold">
            Meu trabalho
        </h2>
        <h3 class="text-gray-600 mt-2">
            Veja os projetos em destaque
        </h3>
    </div>

    <div class="container mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($projects as $project)
            <livewire:components.sections.projects-section.project-card :project="$project" :key="$project->id"/>
        @endforeach
    </div>
</section>
