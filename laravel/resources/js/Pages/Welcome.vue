<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>
    <Head title="Welcome" />

    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
        <div v-if="canLogin" class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
            <Link v-if="$page.props.auth.user" :href="route('dashboard')"
                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
            Dashboard</Link>

            <template v-else>
                <Link :href="route('login')"
                    class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                Log in</Link>

                <Link v-if="canRegister" :href="route('register')"
                    class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                Register</Link>
            </template>
        </div>

        <div class="max-w-7xl mx-auto p-6 lg:p-8">
            <div class="flex justify-center">
                <svg width="70" version="1.1" xmlns="http://www.w3.org/2000/svg" height="70" viewBox="0 0 32 32"
                    xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape">
                    <defs id="defs5455">
                        <linearGradient inkscape:collect="always" id="linearGradient4172-5">
                            <stop style="stop-color:#3daee9" id="stop4174-6" />
                            <stop offset="1" style="stop-color:#6cc1ef" id="stop4176-6" />
                        </linearGradient>
                        <linearGradient inkscape:collect="always" id="linearGradient4342" xlink:href="#linearGradient4172-5"
                            y1="29" y2="8" gradientUnits="userSpaceOnUse" x2="0" />
                    </defs>
                    <metadata id="metadata5458" />
                    <g inkscape:label="Capa 1" inkscape:groupmode="layer" id="layer1"
                        transform="matrix(1 0 0 1 -384.57143 -515.798)">
                        <g inkscape:label="Capa 1" id="layer1-0" transform="matrix(1 0 0 1 -0.000006 0)">
                            <path inkscape:connector-curvature="0" style="fill:#147eb8;fill-rule:evenodd" id="path4308"
                                d="m 386.57144,518.798 0,7 0,1 28,0 0,-6 -14.00001,0 -2,-2 z" />
                            <path inkscape:connector-curvature="0" style="fill-opacity:0.235294;fill-rule:evenodd"
                                id="path4306" d="m 397.57143,523.798 -1.99999,1 -9,0 0,1 6.99999,0 3,0 z" />
                            <path inkscape:connector-curvature="0" style="fill:url(#linearGradient4342)" id="rect4294"
                                d="m 13,8 -2,2 -9,0 -1,0 0,19 11,0 1,0 18,0 0,-21 -18,0 z"
                                transform="matrix(1 0 0 1 384.57143 515.798)" />
                            <path inkscape:connector-curvature="0"
                                style="fill:#ffffff;fill-opacity:0.235294;fill-rule:evenodd" id="path4304"
                                d="m 397.57143,523.798 -2,2 -10,0 0,1 11,0 z" />
                            <path inkscape:connector-curvature="0"
                                style="fill:#ffffff;fill-opacity:0.235294;fill-rule:evenodd" id="path4310"
                                d="m 398.57143,518.798 1,3 15.00001,0 0,-1 -14.00001,0 z" />
                            <rect width="30" x="385.57144" y="543.79797" height="1" style="fill-opacity:0.235294"
                                id="rect4292" />
                        </g>
                        <rect width="0" x="351.19043" y="514.59546" height="10.477185" style="fill:#4d4d4d" id="rect4035" />
                        <rect width="0" x="356.60422" y="530.71735" height="10.477185" style="fill:#4d4d4d"
                            id="rect4035-8" />
                        <rect width="0" x="358.01453" y="529.95966" height="10.477185" style="fill:#4d4d4d"
                            id="rect4035-0" />
                        <rect width="0" x="337.84668" y="511.89462" height="10.477185" style="fill:#4d4d4d"
                            id="rect4035-06" />
                        <rect width="0" x="343.26047" y="528.01648" height="10.477185" style="fill:#4d4d4d"
                            id="rect4035-8-7" />
                        <rect width="0" x="344.67078" y="527.25879" height="10.477185" style="fill:#4d4d4d"
                            id="rect4035-0-42" />
                        <rect width="0" x="337.84668" y="511.89462" height="10.477185" style="fill:#4d4d4d"
                            id="rect4035-3" />
                        <rect width="0" x="343.26047" y="528.01648" height="10.477185" style="fill:#4d4d4d"
                            id="rect4035-8-9" />
                        <rect width="0" x="344.67078" y="527.25879" height="10.477185" style="fill:#4d4d4d"
                            id="rect4035-0-4" />
                        <rect width="0" x="337.84668" y="511.89462" height="10.477185" style="fill:#4d4d4d"
                            id="rect4035-2" />
                        <rect width="0" x="343.26047" y="528.01648" height="10.477185" style="fill:#4d4d4d"
                            id="rect4035-8-99" />
                        <rect width="0" x="344.67078" y="527.25879" height="10.477185" style="fill:#4d4d4d"
                            id="rect4035-0-43" />
                        <rect width="0" x="337.84668" y="511.89462" height="10.477185" style="fill:#4d4d4d"
                            id="rect4035-3-9" />
                        <rect width="0" x="343.26047" y="528.01648" height="10.477185" style="fill:#4d4d4d"
                            id="rect4035-8-9-9" />
                        <rect width="0" x="344.67078" y="527.25879" height="10.477185" style="fill:#4d4d4d"
                            id="rect4035-0-4-4" />
                        <rect width="0" x="392.50122" y="527.10132" height="7.857131" style="fill:#4d4d4d"
                            id="rect4035-5" />
                        <rect width="0" x="388.96075" y="528.9007" height="7.857131" style="fill:#4d4d4d" id="rect4035-7" />
                        <rect width="0" x="385.45471" y="520.03027" height="7.857131" style="fill:#4d4d4d"
                            id="rect4035-9" />
                        <rect width="0" x="386.11118" y="528.7713" height="7.857131" style="fill:#4d4d4d"
                            id="rect4035-96" />
                        <rect width="0" x="382.57071" y="530.57062" height="7.857131" style="fill:#4d4d4d"
                            id="rect4035-7-0" />
                        <rect width="0" x="379.06467" y="521.70026" height="7.857131" style="fill:#4d4d4d"
                            id="rect4035-9-6" />
                        <rect width="0" x="392.50122" y="527.10132" height="7.857131" style="fill:#4d4d4d"
                            id="rect4035-1" />
                        <rect width="0" x="388.96075" y="528.9007" height="7.857131" style="fill:#4d4d4d"
                            id="rect4035-7-2" />
                        <rect width="0" x="385.45471" y="520.03027" height="7.857131" style="fill:#4d4d4d"
                            id="rect4035-9-0" />
                        <rect width="0" x="386.11118" y="528.7713" height="7.857131" style="fill:#4d4d4d"
                            id="rect4035-96-9" />
                        <rect width="0" x="382.57071" y="530.57062" height="7.857131" style="fill:#4d4d4d"
                            id="rect4035-7-0-9" />
                        <rect width="0" x="379.06467" y="521.70026" height="7.857131" style="fill:#4d4d4d"
                            id="rect4035-9-6-9" />
                        <path inkscape:connector-curvature="0" style="fill:#1272a5;stroke-linejoin:round" id="path4218"
                            d="m 400.57143,528.798 a 4,4 0 0 0 -4,4 4,4 0 0 0 0.006,0.17187 2.9999869,2.9999869 0 0 0 -2.00586,2.82813 2.9999869,2.9999869 0 0 0 3,3 l 5.5,0 a 3.5,3.5 0 0 0 3.5,-3.5 3.5,3.5 0 0 0 -2.06055,-3.1875 4,4 0 0 0 -3.93945,-3.3125 z m 0,1 a 3,3 0 0 1 3,3 3,3 0 0 1 -0.002,0.0508 2.5,2.5 0 0 1 2.00195,2.44922 2.5,2.5 0 0 1 -2.5,2.5 l -5.5,0 a 1.999994,2 0 0 1 -2,-2 1.999994,2 0 0 1 2,-2 1.999994,2 0 0 1 0.17773,0.008 3,3 0 0 1 -0.17773,-1.00781 3,3 0 0 1 3,-3 z" />
                    </g>
                </svg>
            </div>

            <div class="mt-16">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                    <a href="https://laravel.com/docs"
                        class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                        <div>
                            <div
                                class="h-16 w-16 bg-blue-50 dark:bg-blue-800/20 flex items-center justify-center rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                                    class="bi bi-bar-chart-line-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M11 2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h1V7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7h1V2z" />
                                </svg>
                            </div>

                            <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Constantly improving</h2>

                            <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                                labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                                laboris nisi ut aliquip ex ea commodo consequat.
                            </p>
                        </div>

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            class="self-center shrink-0 stroke-blue-500 w-6 h-6 mx-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                        </svg>
                    </a>

                    <a href="https://laracasts.com"
                        class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                        <div>
                            <div
                                class="h-16 w-16 bg-blue-50 dark:bg-blue-800/20 flex items-center justify-center rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                                    class="bi bi-file-earmark-lock2-fill" viewBox="0 0 16 16">
                                    <path d="M7 7a1 1 0 0 1 2 0v1H7V7z" />
                                    <path
                                        d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM10 7v1.076c.54.166 1 .597 1 1.224v2.4c0 .816-.781 1.3-1.5 1.3h-3c-.719 0-1.5-.484-1.5-1.3V9.3c0-.627.46-1.058 1-1.224V7a2 2 0 1 1 4 0z" />
                                </svg>
                            </div>

                            <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Data is protected</h2>

                            <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                                labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                                laboris nisi ut aliquip ex ea commodo consequat.
                            </p>
                        </div>

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            class="self-center shrink-0 stroke-red-500 w-6 h-6 mx-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                        </svg>
                    </a>

                    <a href="https://laravel-news.com"
                        class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                        <div>
                            <div
                                class="h-16 w-16 bg-blue-50 dark:bg-blue-800/20 flex items-center justify-center rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                                    class="bi bi-chat-left-text-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H4.414a1 1 0 0 0-.707.293L.854 15.146A.5.5 0 0 1 0 14.793V2zm3.5 1a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9zm0 2.5a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9zm0 2.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5z" />
                                </svg>
                            </div>

                            <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Feedback</h2>

                            <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                                labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                                laboris nisi ut aliquip ex ea commodo consequat.
                            </p>
                        </div>

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            class="self-center shrink-0 stroke-red-500 w-6 h-6 mx-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                        </svg>
                    </a>

                    <div
                        class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                        <div>
                            <div
                                class="h-16 w-16 bg-blue-50 dark:bg-blue-800/20 flex items-center justify-center rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                                    class="bi bi-speedometer" viewBox="0 0 16 16">
                                    <path
                                        d="M8 2a.5.5 0 0 1 .5.5V4a.5.5 0 0 1-1 0V2.5A.5.5 0 0 1 8 2zM3.732 3.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707zM2 8a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 8zm9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5zm.754-4.246a.389.389 0 0 0-.527-.02L7.547 7.31A.91.91 0 1 0 8.85 8.569l3.434-4.297a.389.389 0 0 0-.029-.518z" />
                                    <path fill-rule="evenodd"
                                        d="M6.664 15.889A8 8 0 1 1 9.336.11a8 8 0 0 1-2.672 15.78zm-4.665-4.283A11.945 11.945 0 0 1 8 10c2.186 0 4.236.585 6.001 1.606a7 7 0 1 0-12.002 0z" />
                                </svg>
                            </div>

                            <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">High performance</h2>

                            <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                                labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                                laboris nisi ut aliquip ex ea commodo consequat.
                            </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div></template> 
