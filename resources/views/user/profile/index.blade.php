@extends('layouts.app')

@section('title')
    {{ env('APP_NAME') }}
@endsection

@section('content')

    <section id="order">
        <x-user-profile :selectedProvince="$selectedProvince" :selectedCity="$selectedCity"
                        :selectedBrgy="$selectedBrgy"/>
    </section>

@endsection

@section('extra-js')
    <script>
        $(document).ready(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Delete Account
            $('#deleteAccountBtn').click(function () {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete my account'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: '{!! route('user.destroy', auth()->user()->id) !!}',
                            data: {
                                '_method': 'DELETE'
                            },
                            success: function () {
                                return window.location.href = '/';
                            },
                            error: function () {
                                return window.location.href = '/';
                            }
                        })
                    }
                })
            });
        });
    </script>

    <script src="{{ asset('js/users/changeAvatar.js') }}"></script>
@endsection
