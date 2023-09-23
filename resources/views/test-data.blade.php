<x-app-layout>
    <link rel="shortcut icon" type="image/png" href="/dash/assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="/dash/assets/css/styles.min.css" />
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Test Data') }}
        </h2>
    </x-slot>

    <div class="py-12">
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="card w-100">
                <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Stores Status</h5>
                <div class="table-responsive">
                    <table class="table text-nowrap mb-0 align-middle">
    
                    <thead class="text-dark fs-4">
                        <tr>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Device Name</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">IP Address</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Address</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Status</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Last Login</h6>
                        </th>
                        </tr>
                    </thead>
    
                    <tbody>
                        @foreach ($ipLogs as $store)
                        <tr>
                            <td class="border-bottom-0" style="max-width: 200px; text-wrap: wrap">
                                <span class="fw-normal">{{$store->device_name}}</span>                          
                            </td>
                            <td class="border-bottom-0">
                                <span class="fw-normal">{{$store->ip_address}}</span>                          
                            </td>
                            <td class="border-bottom-0" style="max-width: 200px; text-wrap: wrap">
                                <p class="mb-0 fw-normal">{{$store->address}}</p>
                            </td>
                            <td class="border-bottom-0">
                                <div class="d-flex align-items-center gap-2">
                                <span class="badge bg-{{$store->active == 0 ? "danger" : "success"}} rounded-3 fw-semibold">{{$store->active == 0 ? 'Offline' : 'Online'}}</span>
                                </div>
                            </td>
                            <td class="border-bottom-0">
                                <h6 class="fw-semibold mb-0 fs-4">{{$store->updated_at->diffForHumans()}}</h6>
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
</x-app-layout>
