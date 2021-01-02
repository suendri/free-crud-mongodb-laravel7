<div>

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Mahasiswa</h1>
        <a href="{{ url('/dashboard/mahasiswa/create') }}"
            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-plus fa-sm text-white-50"></i> Tambah Data</a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Mahasiswa</h6>
        </div>
        <div class="card-body">

            <div class="row mb-3">
                <div class="col align-self-start form-inline mb-2 mb-lg-0">
                    Per Page : &nbsp;
                    <select wire:model="perPage" class="form-control">
                        <option>10</option>
                        <option>15</option>
                        <option>25</option>
                    </select>
                </div>

                <div class="col-lg-4 align-self-end">
                    <div class="input-group">
                        <input wire:model="search" class="form-control" type="text" placeholder="Search ...">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fa fa-search"></i></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover" data-form="dataForm">
                            <tr>
                                <th>NO</th>
                                <th>NIM</th>
                                <th>NAMA</th>
                                <th>ALAMAT</th>
                                <th>AKSI</th>
                            </tr>
                            @foreach ($rows as $row)
                                <tr>
                                    <td>{{ $rows->perPage() * ($rows->currentPage() - 1) + $loop->iteration }}</td>
                                    <td>{{ $row->mhsw_nim }}</td>
                                    <td>{{ $row->mhsw_nama }}</td>
                                    <td>{{ $row->mhsw_alamat }}</td>
                                    <td>
                                        <div class="d-flex float-right">
                                            <a href="{{ url('/dashboard/mahasiswa/' . $row->_id . '/edit') }}"
                                                class="btn btn-sm btn-warning">
                                                <i class="fa fa-edit"></i>
                                                <span class="d-none d-lg-inline">EDIT</span>
                                            </a>
                                            <a href="{{ url('/dashboard/mahasiswa/' . $row->_id) }}"
                                                class="btn btn-sm btn-info ml-2">
                                                <i class="fa fa-info-circle"></i>
                                                <span class="d-none d-lg-inline">DETAIL</span>
                                            </a>
                                            <form action="{{ url('/dashboard/mahasiswa/' . $row->_id) }}" method="POST"
                                                class="delete-confirm">
                                                <input type="hidden" name="_method" value="DELETE">
                                                @csrf
                                                <button class="btn btn-danger btn-sm ml-2">
                                                    <i class="fa fa-trash"></i>
                                                    <span class="d-none d-lg-inline">HAPUS</span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 d-flex justify-content-start text-muted mb-3 mb-lg-0">
                    Showing {{ $rows->firstItem() }} to {{ $rows->lastItem() }} out of {{ $rows->total() }} results
                </div>
                <div class="col-lg-6 d-flex justify-content-end">
                    {{ $rows->links() }}
                </div>
            </div>

        </div>
    </div>

    <script>
        $('table[data-form="dataForm"]').on('click', '.delete-confirm', function(e) {
            e.preventDefault();
            var form = $(this);
            Swal.fire({
                title: 'Are you sure?',
                text: 'This record and it`s details will be permanantly deleted!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    form.submit();
                }
            });
        });

    </script>

</div>
