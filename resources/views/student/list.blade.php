
<x-layouts.app title="Students">

    <h1>Students</h1>

    <a href="{{ route('students.create') }}" class="btn">
        Create Student
    </a>

    <div class="table-scroll">
    <table>

        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Date of Birth</th>
                <th>Created</th>
                <th>Updated</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>

            @forelse($students as $student)

                <tr>
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->phone }}</td>
                    <td>{{ $student->address ?: '—' }}</td>
                    <td>{{ $student->date_of_birth?->format('d M Y') ?? '—' }}</td>
                    <td>{{ $student->created_at?->format('d M Y H:i') ?? '—' }}</td>
                    <td>{{ $student->updated_at?->format('d M Y H:i') ?? '—' }}</td>

                    <td>
                        <a href="{{ route('students.show', $student) }}">
                            View
                        </a>

                        <a href="{{ route('students.edit', $student) }}">
                            Edit
                        </a>

                        <x-delete-form
                            :action="route('students.destroy', $student)"
                        />
                    </td>
                </tr>

            @empty

                <tr>
                    <td colspan="9">No students found.</td>
                </tr>

            @endforelse

        </tbody>

    </table>
    </div>

</x-layouts.app>
