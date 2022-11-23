<x-app-layout>
    <div class="flex space-x-2">
        <x-sidebar />
        <div class="flex flex-col w-full">
            <div class="overflow-x-auto" x-data="$store.view">

                @if (Session::has('message'))
                    <div class="alert alert-success shadow-lg">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6"
                                fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{{ Session::get('message') }} <a href="">View</a></span>
                        </div>
                    </div>
                @endif
            </div>

            <div class="min-h-screen bg-green-100 flex items-center justify-center">


                <div class="h-auto w-2/3 bg-white rounded-xl">
                    <div class="nav w-full p-4 flex space-x-52 border-b-2 border-solid">
                        <div>
                            <img src="{{ asset('logo/logo-color.png') }}" class="h-10" />
                        </div>
                        <div class="capitalize text-4xl font-bold">
                            <h1>payroll</h1>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="h-23 p-5">

                            @if ($payroll->user->image()->count() === 0)
                                <img src="https://xsgames.co/randomusers/avatar.php?g=male">
                            @else
                                <img class="h-56"
                                    src="{{ asset('public/Image/' . $payroll->user->image->image_dir) }}">
                            @endif
                            <div>
                                <h1 class="text-2xl">Name: {{ $payroll->user->name }}</h1>
                                @foreach ($payroll->user->position()->get() as $position)
                                    <h2 class="text-sm">Position: {{ $position['name'] }}</h2>
                                @endforeach
                            </div>
                        </div>
                        <div class="w-full p-5">
                            <table class="table w-full">
                                <!-- head -->
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Job</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- row 1 -->
                                    <tr>
                                        <td>Total Days: </td>
                                        <td>{{ $payroll->total_days }}</td>

                                    </tr>
                                    <tr>
                                        <td>Total Work Hours: </td>

                                        <td>{{ $payroll->user->position->hours_work }}</td>

                                    </tr>
                                    <!-- row 2 -->
                                    <tr>
                                        <td>Salary Rate</td>
                                        <td>{{ $payroll->salary_rate }}</td>

                                    </tr>
                                    <tr>
                                        <td>Over Time</td>
                                        <td>{{$payroll->overtime_hours}}</td>
                                    </tr>
                                    <tr>
                                        <td>Over Time Salary</td>
                                        <td>{{$payroll->overtime_salary}}</td>
                                    </tr>

                                    <tr>
                                        <td>Double Pay</td>
                                        <td>{{$payroll->double_pay ?? 'N/A'}}</td>
                                    </tr>

                                    <tr>

                                    @foreach ($payroll->user->deductionSalary()->get() as $deduction)
                                        <tr>
                                            <td>{{ $deduction['name'] }}</td>
                                            <td>{{ $deduction['amount'] }}</td>

                                        </tr>
                                    @endforeach
                                        <td></td>
                                        <td> ₱ {{ number_format($payroll->total, 2, '.', ',') }}</td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="flex flex-row-reverse p-5 mr-10 space-x-5">
                        <form action="{{route('admin.payroll.approve', ['id' => $payroll->id])}}" method="post">

                            @csrf
                            <input type="hidden" name="isApproved" value="true">
                            <button class="btn btn-success">Approve</button>
                        </form>

                        <a href="{{route('admin.payroll.edit', ['id' => $payroll->id])}}" class="btn">Add Deduction</a>
                    </div>
                </div>

            </div>

        </div>
</x-app-layout>
