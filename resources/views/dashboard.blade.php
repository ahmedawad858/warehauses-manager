<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('dashboard.title') }}
        </h2>
            <div class=" text-gray-900 dark:text-gray-100">
                ( {{ __("dashboard.you_re_logged_in") }})
            </div>
        </div>
    </x-slot>

    <div class="py-1">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

            </div>
        </div>
    </div>

    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 pb-6">
{{--        <div class="flex justify-center pt-1     sm:justify-start items-center sm:pt-0">--}}
{{--            <img src="assets/logo3.png" class="w-40" alt="Logo" srcset="">--}}
{{--           <h1 class="text-xl -ms-5  sm:ms-0 dark:text-gray-200 text-gray-6004">{{__("welcome_text.bigTitle" )}}</h1>--}}
{{--        </div>--}}

        <div class="mt-4  bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
            {{--    Section 1 --}}

            <div class="grid grid-cols-1 md:grid-cols-2">
                <div class="p-6">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-8 h-8 text-gray-500">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
                        </svg>
                        <div class="ml-4 text-lg leading-7 font-semibold"><a
                                @if(auth()->check() && auth()->user()->role == "admin")
                                href="{{route("users")}}"
                                @endif
                                class="underline text-gray-900 dark:text-white">{{__("welcome_text.title1")}}</a>
                        </div>
                    </div>

                    <div class="ml-12">
                        <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">{{__("welcome_text.desc1")}}</div>
                    </div>
                </div>
                {{--    Section 2 --}}

                <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-8 h-8 text-gray-500">
                            <path stroke-linecap="round"
                                  d="M15.75 10.5l4.72-4.72a.75.75 0 011.28.53v11.38a.75.75 0 01-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25h-9A2.25 2.25 0 002.25 7.5v9a2.25 2.25 0 002.25 2.25z"/>
                        </svg>
                        <div class="ml-4 text-lg leading-7 font-semibold"><a          @if(auth() && auth()->user()->role != "admin")
                                                                                          href="{{route("warehouses.index")}}"
                                                                                      @endif
                                                                             class="underline text-gray-900 dark:text-white">{{__("welcome_text.title2")}}</a>
                        </div>
                    </div>

                    <div class="ml-12">
                        <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">{{__("welcome_text.desc2")}}</div>
                    </div>
                </div>
                {{--    Section 3 --}}

                <div class="p-6 border-t border-gray-200 dark:border-gray-700">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-8 h-8 text-gray-500">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z"/>
                        </svg>
                        <div class="ml-4 text-lg leading-7 font-semibold"><a    @if(auth() && auth()->user()->role != "admin")
                                                                                    href="{{route("items.index")}}"
                                                                                @endif
                                                                             class="underline text-gray-900 dark:text-white">{{__("welcome_text.title3")}}</a>
                        </div>
                    </div>

                    <div class="ml-12">
                        <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                            {{__("welcome_text.desc3")}}
                        </div>
                    </div>
                </div>
                {{--    Section 4 --}}

                <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-l">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-8 h-8 text-gray-500">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M6.115 5.19l.319 1.913A6 6 0 008.11 10.36L9.75 12l-.387.775c-.217.433-.132.956.21 1.298l1.348 1.348c.21.21.329.497.329.795v1.089c0 .426.24.815.622 1.006l.153.076c.433.217.956.132 1.298-.21l.723-.723a8.7 8.7 0 002.288-4.042 1.087 1.087 0 00-.358-1.099l-1.33-1.108c-.251-.21-.582-.299-.905-.245l-1.17.195a1.125 1.125 0 01-.98-.314l-.295-.295a1.125 1.125 0 010-1.591l.13-.132a1.125 1.125 0 011.3-.21l.603.302a.809.809 0 001.086-1.086L14.25 7.5l1.256-.837a4.5 4.5 0 001.528-1.732l.146-.292M6.115 5.19A9 9 0 1017.18 4.64M6.115 5.19A8.965 8.965 0 0112 3c1.929 0 3.716.607 5.18 1.64"/>
                        </svg>
                        <div
                            class="ml-4 text-lg leading-7 font-semibold text-gray-900 dark:text-white"><a    @if(auth() && auth()->user()->role != "admin")
                                                                                                                 href="{{route("transactions.index")}}"
                                                                                                             @endif
                                                                                                             class="underline text-gray-900 dark:text-white">{{__("welcome_text.title4")}}</a></div>
                    </div>

                    <div class="ml-12">
                        <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">{{__("welcome_text.desc4")}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
