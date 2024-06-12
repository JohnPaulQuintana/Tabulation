<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8 flex items-end justify-end mb-2">
            @include('partials.breadcrum', ['section' => 'Administrator'])
        </div>

        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <span class="text-sm md:text-xl lg:text-xl">Welcome to sports section,
                        {{ auth()->user()->name }}</span>
                </div>

                {{-- tables --}}
                <div class="max-w-12xl mx-auto sm:px-6 lg:px-8 mb-2">


                    <div class="overflow-x-auto sm:rounded-lg p-2 bg-slate-100">
                        <div
                            class="p-2 flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white dark:bg-gray-900">
                            <span>Created Sport's</span>
                            <div class="flex items-center gap-2">
                                <div>
                                    <a href="{{ route('admin.sports.create') }}"
                                        class="bg-blue-500 p-2 rounded-sm text-white hover:bg-blue-700">+Sports</a>
                                </div>
                                <div>
                                    <button id="dropdownActionButton" data-dropdown-toggle="dropdownAction"
                                        class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                                        type="button">
                                        <span class="sr-only">Action button</span>
                                        Filters
                                        <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m1 1 4 4 4-4" />
                                        </svg>
                                    </button>
                                    <!-- Dropdown menu -->
                                    <div id="dropdownAction"
                                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                            aria-labelledby="dropdownActionButton">
                                            <li class="hover:bg-slate-100 p-4">
                                                <a href="#" class="flex items-center px-2">
                                                    <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div>
                                                    Active Sport's
                                                </a>
                                            </li>
                                            <li class="hover:bg-slate-100 p-4">
                                                <a href="#" class="flex items-center px-2">
                                                    <div class="h-2.5 w-2.5 rounded-full bg-red-500 me-2"></div>
                                                    InActive
                                                    Sport's
                                                </a>
                                            </li>


                                        </ul>

                                    </div>
                                </div>
                                <label for="table-search" class="sr-only">Search</label>
                                <div class="relative">
                                    <div
                                        class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                        </svg>
                                    </div>
                                    <input type="text" id="table-search-users"
                                        class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Search for users">
                                </div>
                            </div>
                        </div>
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    {{-- <th scope="col" class="p-4">
                                        <div class="flex items-center">
                                            <input id="checkbox-all-search" type="checkbox"
                                                class="w-4 h-4 text-blue-600 bg-slate-100 border-slate-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="checkbox-all-search" class="sr-only">checkbox</label>
                                        </div>
                                    </th> --}}
                                    <th scope="col" class="px-6 py-3">
                                        Sports Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Type
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Category
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Teams
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Judge
                                    </th>

                                    <th scope="col" class="px-6 py-3">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Date
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Time
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- {{ $sportd }} --}}
                                @foreach ($events as $ev)
                                    <tr
                                        class="bg-white border-b border-slate-200 dark:bg-gray-800 dark:border-gray-700 hover:bg-slate-100 dark:hover:bg-gray-600">

                                        <th scope="row"
                                            class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                            <img class="w-10 h-10 rounded-sm"
                                                src="{{ asset('storage') . '/' . $ev->image }}" alt="Jese image">
                                            <div class="ps-3">
                                                <div class="text-base font-semibold">{{ $ev->name }}</div>
                                                <div class="font-normal text-gray-500">Santiago City</div>
                                            </div>
                                        </th>
                                        <td class="px-6 py-4 capitalize">
                                            {{ $ev->type }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <i class="fa-solid fa-list"></i>
                                            <a type="button" data-id="{{ $ev->id }}"
                                                class="create-category font-bold text-blue-500 hover:cursor-pointer hover:text-blue-700">
                                                {{ count($ev->sportsCategories) }}+
                                            </a>
                                        </td>
                                        <td class="px-6 py-4">
                                            <i class="fa-regular fa-user-group-simple"></i>
                                            <a type="button" data-id="{{ $ev->id }}"
                                                class="create-teams font-bold text-blue-500 hover:cursor-pointer hover:text-blue-700">
                                                {{ count($ev->teams) }}+
                                            </a>
                                        </td>
                                        <td class="px-6 py-4">
                                            <i class="fa-regular fa-user-group-simple"></i>
                                            <a href="{{ route('admin.judge', $ev->id) }}" data-id="{{ $ev->id }}"
                                                class="font-bold text-blue-500 hover:cursor-pointer hover:text-blue-700">
                                                {{ count($ev->judge) }}+
                                            </a>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                @switch($ev->status)
                                                    @case(0)
                                                        <div class="h-2.5 w-2.5 rounded-full bg-red-500 me-2"></div> Offline
                                                    @break

                                                    @default
                                                        <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div> Online
                                                @endswitch
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span>{{ \Carbon\Carbon::parse($ev->date)->format('F d, Y') }}</span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span>{{ \Carbon\Carbon::parse($ev->time)->format('h:i A') }}</span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="{{ route('admin.event.edit', $ev->id) }}"><i
                                                    class="fa-solid fa-pen-to-square text-xl text-red-500 hover:text-red-700"></i></a>
                                            <a href="{{ route('admin.sports.game', $ev->id) }}"><i
                                                    class="fa-solid fa-circle-play text-xl text-blue-500 hover:text-blue-700"></i></a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @if (session('status'))
        @include('admin.popup.success')
    @endif

    @include('admin.sport.modal.edit')
    @include('admin.sport.modal.category')
    @include('admin.sport.modal.team')

    @section('scripts')
        <script>
            let teams = @json($events);
            let validation = @json(session('validation'));
            let modal = @json(session('modal'));
            let modalEdit = @json(session('modal-edit'));
            let eid = @json(session('event_id'));
            let cid = @json(session('category_id'));
            console.log(teams)
            $(document).ready(function() {

                if (validation && modal) {
                    // alert("Category Name", 'This field is required!', 'error');
                    filterCategory(teams, eid)
                    $('#category_error').removeClass('hidden')
                    $('#category_event_id').val(eid);
                    $('#openModalCategory').trigger('click');

                } else if (validation === false && modal === false) {
                    alert("Category Saved", 'Category saved successfully!', 'success');
                } else if (validation && modalEdit) {
                    $('.backButton').addClass('hidden')
                    $('#category_edit_error').removeClass('hidden')
                    $('#category_event_id_edit').val(eid);
                    $('#category_category_id_edit').val(cid);
                    $('#openModalCategoryEdit').trigger('click');
                }
                // create teams
                $('.create-teams').click(function() {
                    // alert($(this).data('id'))
                    let event_id = $(this).data('id');

                    //filter the events based on event id click
                    filterEvents(teams, event_id);
                    $('#sport_event_id').val(event_id);
                    $('#openModalTeams').trigger('click');
                })
                $('#modalCloseBtn').click(function() {
                    // alert('dwadwad')
                    $('#modalBackdrop').addClass('hidden')
                    $('#successModal').addClass('hidden')
                })

                //end of create teams

                //create category
                $('.create-category').click(function() {
                    // alert($(this).data('id'))
                    let event_id = $(this).data('id');

                    //filter the events based on event id click
                    filterCategory(teams, event_id);
                    $('#category_event_id').val(event_id);
                    $('#openModalCategory').trigger('click');
                })
                //end create category





            })

            const filterEvents = (teams, id) => {
                let renderTeams = ''
                const routes = {};
                teams.forEach(team => {
                    // console.log(team)
                    if (team.id === id) {
                        // console.log(team.teams)
                        team.teams.forEach(t => {
                            routes[t.id] = "{{ route('admin.sports.team', ':id') }}".replace(':id', t.id);
                            // console.log(routes[t.id])
                            renderTeams += `
                                    <a class="group flex flex-col bg-white border shadow-sm rounded-xl hover:shadow-md transition dark:bg-neutral-900 dark:border-neutral-800" href="${routes[t.id]}">
                                        <div class="p-2 md:p-2">
                                            <div class="flex justify-between items-center">
                                            <div class="flex items-center">
                                                <img class="size-[38px] rounded-full" src="{{ asset('storage') }}/${t.profile}" alt="Image Description">
                                                <div class="ms-3">
                                                <h4 class="group-hover:text-blue-600 text-sm font-semibold text-gray-800 dark:group-hover:text-neutral-400 dark:text-neutral-200">
                                                    ${t.team_name}
                                                </h4>
                                                </div>
                                            </div>
                                            <div class="ps-3">
                                                <svg class="flex-shrink-0 size-5 text-gray-800 dark:text-neutral-200" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                                            </div>
                                            </div>
                                        </div>
                                    </a>
                                `
                        });

                        $('#renderTeams').html(renderTeams)
                    }
                });
            }

            const filterCategory = (events, id) => {
                let categories = '';
                events.forEach(e => {

                    if (e.id === id) {
                        console.log(e)
                        e.sports_categories.forEach(c => {
                            categories += `
                                    <a data-event_id="${id}" data-id="${c.id}" data-category="${c.category}" class="category_edit group flex flex-col bg-white border shadow-sm rounded-md hover:shadow-md transition hover:cursor-pointer">
                                        <div class="p-2 md:p-2">
                                            <div class="flex justify-between items-center">
                                            <div class="flex items-center">
                                                <i class="fa-solid fa-layer-group text-xl"></i>
                                                <div class="ms-3">
                                                <h4 class="group-hover:text-blue-600 text-sm font-semibold text-gray-800 dark:group-hover:text-neutral-400 dark:text-neutral-200">
                                                    ${c.category}
                                                </h4>
                                                </div>
                                            </div>
                                                <div class="ps-3">
                                                    <svg class="flex-shrink-0 size-5 text-gray-800 dark:text-neutral-200" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                `
                        });

                        $('#renderCategories').html(categories)
                    }
                });

                $('.category_edit').click(function() {
                    let event_id = $(this).data('event_id')
                    let category_id = $(this).data('id')
                    let category = $(this).data('category')
                    $('#category_event_id_edit').val(event_id);
                    $('#category_category_id_edit').val(category_id);
                    $('#category_edit').val(category);
                    $('#openModalCategoryEdit').trigger('click');
                })


            }
            $('.closeModalCategoryEdit').click(function() {
                window.location.reload()
            })

            const alert = (t, m, i) => {
                Swal.fire({
                    title: t,
                    text: m,
                    icon: i
                });
            }
        </script>
    @endsection
</x-app-layout>
