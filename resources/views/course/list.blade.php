<!DOCTYPE html>
<html>

<head>
    <title>Courses</title>
</head>

<body>

<h1>Courses</h1>


@if(session('success'))

    <p>
        {{ session('success') }}
    </p>

@endif


<a href="/course/create">
    Create Course
</a>


<br>
<br>


<table border="1" cellpadding="10">

    <thead>

        <tr>
            <th>ID</th>
            <th>Course Name</th>
            <th>Code</th>
            <th>Description</th>
            <th>Credits</th>
            <th>Actions</th>
        </tr>

    </thead>


    <tbody>

    @forelse($courses as $course)

        <tr>

            <td>
                {{ $course->id }}
            </td>

            <td>
                {{ $course->name }}
            </td>

            <td>
                {{ $course->code }}
            </td>

            <td>
                {{ $course->description }}
            </td>

            <td>
                {{ $course->credits }}
            </td>

            <td>

                <a href="/courses/{{ $course->id }}">
                    View
                </a>

                <a href="/courses/{{ $course->id }}/edit">
                    Edit
                </a>

                <form
                    action="/courses/{{ $course->id }}"
                    method="POST"
                    style="display:inline"
                >

                    @csrf

                    @method('DELETE')

                    <button type="submit">
                        Delete
                    </button>

                </form>

            </td>

        </tr>

    @empty

        <tr>

            <td colspan="6">
                No courses found.
            </td>

        </tr>

    @endforelse

    </tbody>

</table>

</body>

</html>