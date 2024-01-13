@extends('layouts.scaffold')
@push('titles')
    {{ $title ?? '' }}
@endpush
@push('styles')
<style>
    .no-drop {
        cursor: no-drop;
    }
</style>
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush
@section('content')
<div class="body flex-grow-1 px-3">
    <div class="container-lg">
      <div class="fs-2 fw-semibold">{{ $title ?? '' }}</div>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-4">
          <li class="breadcrumb-item">
            <!-- if breadcrumb is single--><span>Home</span>
          </li>
          <li class="breadcrumb-item active"><span>{{ $title ?? '' }}</span></li>
        </ol>
        <button data-coreui-toggle="modal" data-coreui-target="#AddCountry" style="float: right; margin-top: -80px;" type="button" class="btn btn-primary">Add Country</button>
      </nav>
    </div>


    <div class="tab-content rounded-bottom bg-white ">
        <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1005">
          <table class="table table-hover table-striped" id="CountryTable">
            <thead>
              <tr>
                <th scope="col">Name</th>
                <th scope="col">Phonecode</th>
                <th scope="col">Code</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
  </div>


  @include('pages.country.create')
  @include('pages.country.edit')
@endsection
@push('scripts')
<script src="https://code.jquery.com/jquery-3.5.0.js" integrity="sha256-r/AaFHrszJtwpe+tHyNi/XCfMxYpbsRg2Uqn0x3s2zc=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>


    <script>
          $(document).ready(function (){
            $('#CountryTable').DataTable({
                ajax: {
                    url: "{{ route('country.list') }}",
                    dataSrc: 'countries',
                },
                columns: [{
                    data: "name",
                },
                {
                    data: "phonecode",
                },
                {
                    data: "code",
                },
                {
                    data: "action",
                    searchable: false,
                    orderable: false,
                },
                ],
                deferRender: true,
                processing: true,
                serverSide: true,
                autoWidth: true,
                responsive: true,
                info: true,
                paging: true,
                order:[
                    [0,'asc']
                ],
            });
        });
        $(document).on('submit' , '#createCountry', async function(event) {
            event.preventDefault();
            const createCountry = $(this);
            const formData = new FormData(createCountry[0]);

            createCountry.find('input ,button').addClass('no-drop').attr('disabled' , true);
            createCountry.find('.is-invalid').removeClass('is-invalid');
            createCountry.find('.invalid-feedback').remove();
            try{
                const response = await $.ajax({
                    url: "{{ route('country.store') }}",
                    type: "POST",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    headers:{
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                })
                $('#AddCountry').modal('hide');
                swal({
                    icon: 'success',
                    title: 'Country created',
                });
                $('#CountryTable').DataTable().ajax.reload(null,false);
                createCountry.get(0).reset();
            }catch (err) {
                    if (err.status === 422) {
                        const errors = err.responseJSON.errors;
                        Object.keys(errors).forEach(key => {
                            const err = errors[key];
                            const input = createCountry.find(`[name="${key}"]`);
                            if (input.length > 0) {
                                input.addClass('is-invalid');
                                input.parent().append(
                                    $("<span class='invalid-feedback'>").html(err.join('<br/>'))
                                );
                            } else {
                                console.error(`Input with name ${key} doesn't exist!`);
                            }
                        });
                    }
                }
                createCountry.find('input ,button').removeClass('no-drop').removeAttr('disabled');
        });
        $(document).on('click' , '.country-edit' , async function (event) {
            const btn = $(this)[0];
            try{
                const country_id = btn.getAttribute('data-country-id');
                btn.setAttribute('disabled' , true);

                const response = await $.ajax({
                    method: "GET",
                    url: "{{ route('country.show' , '__COUNTRY_ID__')  }}".replace('__COUNTRY_ID__', country_id),
                });

                const countryDetails = response.country;

                $('#EditCountry [name="name"]').val(countryDetails.name);
                $('#EditCountry [name="phonecode"]').val(countryDetails.phonecode);
                $('#EditCountry [name="code"]').val(countryDetails.code);
                $('#EditCountry').attr('data-country-id',country_id);
                $('#EditCountry').modal('show');
            } catch (err) {
                console.log(err)
            }
            btn.removeAttribute('disabled');
        });
        $(document).on('submit' , '#updateCountry' , async function(event) {
            event.preventDefault();
            const UpdateCountry = $(this);
            const country_id = $('#EditCountry').attr('data-country-id');
            const formData = new FormData(UpdateCountry.get(0));
            try{
                UpdateCountry.find('input, button').addClass('no-drop').attr('disabled', true);
                UpdateCountry.find('.is-invalid').removeClass('is-invalid');
                UpdateCountry.find('.invalid-feedback').remove();

                const response = await $.ajax({
                    url: "{{ route('country.update','__COUNTRY_ID__') }}".replace('__COUNTRY_ID__',country_id),
                    method: "POST",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    },
                })
                $('#EditCountry').modal('hide');
                swal({
                    icon: 'success',
                    title: 'Country updated',
                });
                $("#areaListTable").DataTable().ajax.reload(null, false);
                UpdateCountry.get(0).reset();
            }   catch (err) {
                    if (err.status === 422) {
                        const errors = err.responseJSON.errors;
                        Object.keys(errors).forEach(key => {
                            const err = errors[key];
                            const input = UpdateCountry.find(`[name="${key}"]`);
                            if (input.length > 0) {
                                input.addClass('is-invalid');
                                input.parent().append(
                                    $("<span class='invalid-feedback'>").html(err.join('<br/>'))
                                );
                            } else {
                                console.error(`Input with name ${key} doesn't exist!`);
                            }
                        });
                    }
                }
                UpdateCountry.find('input ,button').removeClass('no-drop').removeAttr('disabled');
        });
        $(document).on('click' , '.country-delete' , async function(event) {
            const country_id = $(this).attr('data-country-id');
            const result = await swal({
                icon: 'warning',
                title: 'Are you sure you want to delete this data?',
                buttons: {
                    cancel: 'No',
                    confirm: 'Yes'
                },
            });

            const formData = new FormData();
            formData.append('_method', 'DELETE');

            if(result.buttons,confirm){
                try{
                    const resposne = await $.ajax({
                        method: "DELETE",
                        url: "{{ route('country.delete','__COUNTRY_ID__') }}".replace('__COUNTRY_ID__' , country_id),
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}",
                        },
                    })
                    swal({
                        icon: 'success',
                        title: "Country deleted",
                    });
                    $("#CountryTable").DataTable().ajax.reload(null, false);
                } catch (err) {
                        swal({
                            icon: 'error',
                            title: `${err.status} Error occured while deleting record!`,
                            html: err.message
                        });
                }
            }
        })
    </script>
@endpush
