@extends('layout.admin.admin')

@section('content')
<div class="p-6 mb-6">
    <h2 class="text-2xl font-bold ">Reservations Management</h2>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead>
                <tr class="bg-white text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">ID</th>
                    <th class="py-3 px-6 text-left">User</th>
                    <th class="py-3 px-6 text-left">Trip</th>
                    <th class="py-3 px-6 text-left">Destination</th>
                    <th class="py-3 px-6 text-left">Date</th>
                    <th class="py-3 px-6 text-left">Amount</th>
                    <th class="py-3 px-6 text-left">Persons</th>
                    <th class="py-3 px-6 text-left">Status</th>
                    <th class="py-3 px-6 text-left">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm">
                @forelse($reservations as $reservation)
                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                        <td class="py-3 px-6">{{ $reservation->id }}</td>
                        <td class="py-3 px-6">{{ $reservation->user->name }}</td>
                        <td class="py-3 px-6">{{ $reservation->trip->name }}</td>
                        <td class="py-3 px-6">{{ $reservation->trip->destination->name }}</td>
                        <td class="py-3 px-6">{{ $reservation->trip->start_date->format('M d, Y') }}</td>
                        <td class="py-3 px-6">{{ $reservation->amount }} MAD</td>
                        <td class="py-3 px-6">{{ $reservation->number_of_persons }}</td>
                        <td class="py-3 px-6">
                            <span class="px-2 py-1 rounded-full text-xs {{
                                $reservation->status === 'completed' ? 'bg-green-100 text-green-800' :
                                ($reservation->status === 'cancelled' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800')
                            }}">
                                {{ ucfirst($reservation->status) }}
                            </span>
                        </td>
                        <td class="py-3 px-6">
                            <a href="{{ route('admin.reservations.show', $reservation) }}" class="text-blue-600 hover:text-blue-900 mr-2">
                                <i class="fas fa-eye"></i> View
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="py-6 px-6 text-center text-gray-500">No reservations found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $reservations->links() }}
    </div>
</div>
@endsection
