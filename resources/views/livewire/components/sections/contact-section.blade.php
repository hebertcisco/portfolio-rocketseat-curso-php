<section id="projects" class="bg-cover bg-center bg-no-repeat p-[100px] w-[100vw] h-[100vh] flex flex-col items-center"
         style="background-image: url('{{asset('/assets/images/hero-bg.svg')}}');">

    <div class="container mx-auto text-center mb-8">
        <h2 class="text-[#E3646E] text-3xl font-bold">
            Contato
        </h2>
        <h3 class="text-gray-100 mt-2">
            Gostou do meu trabalho?
        </h3>
        <p class="text-gray-400 mt-2">
            Entre em contato ou acompanhe as minhas redes sociais!
        </p>
    </div>

    <div class="flex flex-col align-center space-y-4 text-center justify-center">
        <livewire:components.sections.contact-section.social-link icon="fab fa-linkedin-in" link="https://www.linkedin.com/in/hebert-f-barros/" title="LinkedIn" />
        <livewire:components.sections.contact-section.social-link icon="fab fa-github" link="https://github.com/hebertcisco" title="GitHub" />
        <livewire:components.sections.contact-section.social-link icon="fa fa-newspaper" link="https://www.tabnews.com.br/hebertcisco" title="TabNews" />
    </div>
</section>
