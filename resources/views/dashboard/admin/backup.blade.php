@foreach($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->nim }}</td>
                        <td>{{ $user->email }}</td>                      
                      <td>                        
                        <a href="{{ route('dashboard.admin.edit', $user->id) }}" 
                            class="text-success me-2 edituser"
                            data-id="{{ $user->id }}"
                            data-bs-toggle="modal"
                            data-bs-target="#edituser"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Edit Admin">
                            <i class="mdi mdi-pencil-outline"></i>
                        </a>
                        <a href="/dashboard/admin/{{ $user->id }}/removeAdmin" 
                            class="text-danger"
                            onclick="return confirm('Ubah admin menjadi mahasiswa?')"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Hapus Hak Admin">
                            <i class="mdi mdi-delete-outline"></i>
                        </a>
                      </td>
                    </tr>
                    @endforeach 