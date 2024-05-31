<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8 flex items-end justify-end mb-2">
            @include('partials.breadcrum', ['section' => 'Create Events'])
        </div>

        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <span class="text-sm md:text-xl lg:text-xl">Welcome to create category section,
                        {{ auth()->user()->name }}
                    </span>
                </div>

                {{-- create events --}}
                <div class="max-w-12xl mx-auto sm:px-6 lg:px-8 mb-2">


                    <div class="overflow-x-auto sm:rounded-lg">
                        <div>
                            <div
                                class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 bg-white dark:bg-gray-900 text-xl">
                                <span>Create Categories</span>
                                <span class="text-md">Total : <span class="text-green-500">{{ count($categories) }}</span></span>
                                <!-- Button to add more categories -->
                                {{-- <button type="button" id="addCategory" class="bg-green-500 text-white px-4 text-sm p-1 rounded-md mb-4">Add Category</button> --}}
                            </div>
                            <form action="{{ route('admin.category.store') }}" method="post"
                                enctype="multipart/form-data" class="p-1">
                                @csrf

                                @if (session('save_category') == 'success')
                                    <input type="number" name="event_id" value="{{ session('event_id') }}"
                                        class="hidden">
                                @else
                                    <input type="number" name="event_id" value="{{ $event_id }}" class="hidden">
                                @endif


                                <div id="categoryFields"
                                    class="rounded-md border-slate-300 p-2 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-2">

                                    <!-- Category fields -->
                                    <div class="bg-slate-100 p-2 border-t-4 border-red-500">
                                        <div class="flex flex-col mb-2">
                                            <div class="flex justify-between items-center mb-1">
                                                <label for="">Category Name</label>
                                                {{-- <i class="fa-solid fa-square-xmark text-xl text-red-500 hover:text-red-700 hover:cursor-pointer"></i> --}}
                                            </div>
                                            <div class="flex gap-2 items-center">
                                                <i class="fa-solid fa-circle-dot text-red-500"></i>
                                                <input type="text" name="categories"
                                                    class="rounded-md border-0 flex-1">
                                            </div>
                                        </div>

                                        <div class="flex flex-col ">
                                            <div class="flex justify-between items-center">
                                                <label for="">Criteria</label>

                                            </div>
                                            <div class="flex flex-col gap-2">
                                                <div class="flex gap-2 items-center">
                                                    <i class="fa-solid fa-circle-dot text-red-500"></i>
                                                    <input type="text" name="sub_categories[]"
                                                        class="rounded-md border-0 flex-1">
                                                    <input type="number" name="percentage[]" min="10"
                                                        max="100" class="rounded-md border-0 w-1/3"
                                                        placeholder="10 - 100%">
                                                </div>
                                                <div class="flex gap-2 items-center">
                                                    <i class="fa-solid fa-circle-dot text-red-500"></i>
                                                    <input type="text" name="sub_categories[]"
                                                        class="rounded-md border-0 flex-1">
                                                    <input type="number" name="percentage[]" min="10"
                                                        max="100" class="rounded-md border-0 w-1/3"
                                                        placeholder="10 - 100%">
                                                </div>
                                                <div class="flex gap-2 items-center">
                                                    <i class="fa-solid fa-circle-dot text-red-500"></i>
                                                    <input type="text" name="sub_categories[]"
                                                        class="rounded-md border-0 flex-1">
                                                    <input type="number" name="percentage[]" min="10"
                                                        max="100" class="rounded-md border-0 w-1/3"
                                                        placeholder="10 - 100%">
                                                </div>
                                                <div class="flex gap-2 items-center">
                                                    <i class="fa-solid fa-circle-dot text-red-500"></i>
                                                    <input type="text" name="sub_categories[]"
                                                        class="rounded-md border-0 flex-1">
                                                    <input type="number" name="percentage[]" min="10"
                                                        max="100" class="rounded-md border-0 w-1/3"
                                                        placeholder="10 - 100%">
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex flex-col gap-3 max-h-[350px] overflow-y-auto">
                                        {{-- created category list --}}

                                        @foreach ($categories as $c)
                                            <div class="bg-slate-100 p-2 border-t-4 border-green-500 shadow-1">
                                                <div class="flex flex-col mb-2">
                                                    <div class="flex justify-between items-center mb-1">
                                                        <label for="">Category Name</label>
                                                        <div class="flex items-center gap-2">

                                                            <i data-category_id="{{ $c->id }}"
                                                                class="edit_category fa-sharp fa-solid fa-pen-to-square text-[22px] text-green-500 hover:cursor-pointer hover:text-green-700"></i>
                                                            <i
                                                                class="fa-solid fa-square-xmark text-2xl text-red-500 hover:text-red-700 hover:cursor-pointer"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex gap-2 items-center">
                                                        <i class="fa-solid fa-circle-dot text-green-500"></i>
                                                        <input type="text" class="rounded-md border-0 flex-1"
                                                            value="{{ $c->category_name }}" readonly>
                                                    </div>
                                                </div>

                                                <div class="flex flex-col ">
                                                    <div class="flex justify-between items-center">
                                                        <label for="">Criteria</label>
                                                        <div class="text-green-500">
                                                            (percentage)
                                                        </div>
                                                    </div>
                                                    <div class="flex flex-col gap-2">

                                                        @foreach ($c->subCategory as $s)
                                                            <div class="flex gap-2 items-center">
                                                                <i class="fa-solid fa-circle-dot text-green-500"></i>
                                                                <input type="text"
                                                                    class="rounded-md border-0 flex-1"
                                                                    value="{{ $s->sub_category }}" readonly>
                                                                <input type="number" min="10" max="100"
                                                                    class="rounded-md border-0 w-1/3"
                                                                    value="{{ $s->percentage }}" readonly>
                                                            </div>
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                </div>
                                <div>
                                    <a href="{{ route('admin.event') }}"
                                        class="bg-red-500 text-white p-2 rounded-sm">Cancel</a>
                                    <button type="submit" class="bg-blue-500 text-white p-1 rounded-sm">Save
                                        Category</button>
                                </div>
                            </form>
                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>

    @include('admin.category.edit')

    @if (session('status'))
        @include('admin.popup.status', ['status'=>session('status')]);
    @endif
    @section('scripts')
        <script>
            $(document).ready(function() {
                let status = @json(session('save_category'));
                let categories = @json($categories);
                console.log(categories)
                if (status !== null) {
                    successMessage()
                }

                $(".edit_category").click(function(){
                    // alert($(this).data('category_id'))
                    renderCriteria($(this).data('category_id'),categories)
                    $('#editBackdrop').removeClass('hidden')
                    $('#editModal').removeClass('hidden')
                })

                $('#editCloseBtn').click(function(){
                    $('#editBackdrop').addClass('hidden')
                    $('#editModal').addClass('hidden')
                })
                $('#statusCloseBtn').click(function(){
                    $('#statusBackdrop').addClass('hidden')
                    $('#statusModal').addClass('hidden')
                })
            })

            // render criterria
            const renderCriteria = (id,category) => {
                let renderCriteria = ''
                category.forEach(c => {
                    if(id === c.id){
                        // console.log(c)
                        $('#type').val('category')
                        $('#category_name').val(c.category_name)
                        $('#category_id').val(id)
                        c.sub_category.forEach(sc => {
                            console.log(sc)
                            renderCriteria += `
                                <div class="flex gap-2 justify-between items-center shadow mb-2 p-2">
                                    <div class="">
                                        <label for="">Criteria:</label>
                                        <input type="text" name="criteria[]" value="${sc.sub_category}" class="rounded-md w-full">
                                    </div>
                                    
                                    <div class="">
                                        <label for="">Percentage:</label>
                                        <input type="number" name="percentage[]" value="${sc.percentage}" class="rounded-md w-full">
                                    </div>
                                </div>
                            `
                        })

                        $('#renderEditCriteriaContainer').html(renderCriteria)
                    }
                    
                });
            }

            const successMessage = () => {
                Swal.fire({
                    title: "Category is successfully added!",
                    text: "You can add more categories!",
                    icon: "success"
                });
            }

        </script>
    @endsection
</x-app-layout>
