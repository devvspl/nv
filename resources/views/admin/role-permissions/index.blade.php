@extends('layouts.admin')

@section('title', 'Role Permission Mapping')

@section('content')
<div class="space-y-6" x-data="{ activeRole: '{{ array_key_first($roles) }}' }">

    {{-- Page Header --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="text-2xl font-heading text-zendo-navy font-semibold">Role Permission Mapping</h2>
            <p class="text-gray-600 mt-1">Control what each role can access across the admin panel</p>
        </div>
        {{-- Role summary badges --}}
        <div class="flex flex-wrap gap-2">
            @foreach($roles as $roleKey => $roleLabel)
            @php
                $badgeClass = match($roleKey) {
                    'super_admin' => 'bg-purple-100 text-purple-800 border-purple-200',
                    'admin'       => 'bg-blue-100 text-blue-800 border-blue-200',
                    default       => 'bg-gray-100 text-gray-700 border-gray-200',
                };
            @endphp
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium border {{ $badgeClass }}">
                <span class="w-1.5 h-1.5 rounded-full
                    @if($roleKey === 'super_admin') bg-purple-500
                    @elseif($roleKey === 'admin') bg-blue-500
                    @else bg-gray-400 @endif"></span>
                {{ $roleLabel }} — {{ count($assigned[$roleKey] ?? []) }} permissions
            </span>
            @endforeach
        </div>
    </div>

    @if(session('success'))
    <div class="flex items-center gap-3 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
        </svg>
        {{ session('success') }}
    </div>
    @endif

    {{-- Role Tab Card --}}
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">

        {{-- Tab Bar --}}
        <div class="border-b border-gray-200 bg-gray-50 px-6 pt-4">
            <div class="flex gap-1">
                @foreach($roles as $roleKey => $roleLabel)
                @php
                    $activeTab   = "border-zendo-gold text-zendo-gold bg-white shadow-sm";
                    $inactiveTab = "border-transparent text-gray-500 hover:text-gray-700 hover:bg-white/60";
                    $dot = match($roleKey) {
                        'super_admin' => 'bg-purple-500',
                        'admin'       => 'bg-blue-500',
                        default       => 'bg-gray-400',
                    };
                @endphp
                <button type="button"
                    @click="activeRole = '{{ $roleKey }}'"
                    :class="activeRole === '{{ $roleKey }}' ? '{{ $activeTab }}' : '{{ $inactiveTab }}'"
                    class="flex items-center gap-2 px-5 py-3 text-sm font-medium border-b-2 rounded-t-lg transition-all whitespace-nowrap -mb-px">
                    <span class="w-2 h-2 rounded-full {{ $dot }}"></span>
                    {{ $roleLabel }}
                    <span class="ml-1 px-1.5 py-0.5 rounded text-xs font-semibold
                        @if($roleKey === 'super_admin') bg-purple-100 text-purple-700
                        @elseif($roleKey === 'admin') bg-blue-100 text-blue-700
                        @else bg-gray-200 text-gray-600 @endif">
                        {{ count($assigned[$roleKey] ?? []) }}
                    </span>
                </button>
                @endforeach
            </div>
        </div>

        {{-- Per-role panels --}}
        @foreach($roles as $roleKey => $roleLabel)
        <div x-show="activeRole === '{{ $roleKey }}'" x-cloak>
            <form action="{{ route('admin.role-permissions.update', $roleKey) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Toolbar --}}
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 px-6 py-4 border-b border-gray-100">
                    <p class="text-sm text-gray-600">
                        Editing permissions for
                        <span class="font-semibold text-gray-900
                            @if($roleKey === 'super_admin') text-purple-700
                            @elseif($roleKey === 'admin') text-blue-700
                            @else text-gray-700 @endif">
                            {{ $roleLabel }}
                        </span>
                    </p>
                    <div class="flex items-center gap-2">
                        <button type="button" onclick="toggleAll('{{ $roleKey }}', true)"
                            class="inline-flex items-center gap-1.5 text-xs px-3 py-1.5 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-50 hover:border-gray-400 transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Select All
                        </button>
                        <button type="button" onclick="toggleAll('{{ $roleKey }}', false)"
                            class="inline-flex items-center gap-1.5 text-xs px-3 py-1.5 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-50 hover:border-gray-400 transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Deselect All
                        </button>
                    </div>
                </div>

                {{-- Permission Grid --}}
                <div class="p-6">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        @foreach($permissions as $module => $perms)
                        <div class="border border-gray-200 rounded-lg overflow-hidden hover:border-gray-300 transition-colors">
                            {{-- Module Header --}}
                            <div class="flex items-center justify-between px-4 py-2.5 bg-gray-50 border-b border-gray-200">
                                <div class="flex items-center gap-2.5">
                                    <input type="checkbox"
                                        id="module_{{ $roleKey }}_{{ Str::slug($module) }}"
                                        class="module-toggle w-4 h-4 rounded cursor-pointer"
                                        data-role="{{ $roleKey }}"
                                        data-module="{{ $module }}"
                                        onchange="toggleModule('{{ $roleKey }}', '{{ $module }}', this.checked)">
                                    <label for="module_{{ $roleKey }}_{{ Str::slug($module) }}"
                                        class="text-sm font-semibold text-gray-800 capitalize cursor-pointer select-none">
                                        {{ str_replace('-', ' ', $module) }}
                                    </label>
                                </div>
                                <span class="text-xs text-gray-400 bg-gray-200 px-2 py-0.5 rounded-full">
                                    {{ $perms->count() }} {{ Str::plural('action', $perms->count()) }}
                                </span>
                            </div>

                            {{-- Action Checkboxes --}}
                            <div class="px-4 py-3 flex flex-wrap gap-3 bg-white">
                                @foreach($perms as $perm)
                                @php
                                    $checked = in_array($perm->name, $assigned[$roleKey] ?? []);
                                    $actionStyle = match($perm->action) {
                                        'view'   => 'text-blue-700 bg-blue-50 border-blue-200',
                                        'create' => 'text-green-700 bg-green-50 border-green-200',
                                        'edit'   => 'text-amber-700 bg-amber-50 border-amber-200',
                                        'delete' => 'text-red-700 bg-red-50 border-red-200',
                                        default  => 'text-gray-700 bg-gray-50 border-gray-200',
                                    };
                                @endphp
                                <label class="flex items-center gap-2 px-3 py-1.5 rounded-lg border cursor-pointer select-none transition-all hover:shadow-sm {{ $actionStyle }} {{ $checked ? 'ring-1 ring-offset-0' : 'opacity-70 hover:opacity-100' }}
                                    @if($perm->action === 'view') {{ $checked ? 'ring-blue-300' : '' }}
                                    @elseif($perm->action === 'create') {{ $checked ? 'ring-green-300' : '' }}
                                    @elseif($perm->action === 'edit') {{ $checked ? 'ring-amber-300' : '' }}
                                    @elseif($perm->action === 'delete') {{ $checked ? 'ring-red-300' : '' }}
                                    @endif">
                                    <input type="checkbox"
                                        name="permissions[]"
                                        value="{{ $perm->name }}"
                                        {{ $checked ? 'checked' : '' }}
                                        class="perm-checkbox w-3.5 h-3.5 rounded cursor-pointer"
                                        data-role="{{ $roleKey }}"
                                        data-module="{{ $module }}"
                                        onchange="syncModuleToggle('{{ $roleKey }}', '{{ $module }}')">
                                    <span class="text-xs font-semibold capitalize">{{ $perm->action }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Footer Save --}}
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex flex-col sm:flex-row items-center justify-between gap-3">
                    <p class="text-xs text-gray-500">
                        Changes take effect immediately after saving. Permission cache is cleared automatically.
                    </p>
                    <button type="submit"
                        class="inline-flex items-center px-6 py-2.5 bg-zendo-gold text-white font-semibold rounded-lg hover:bg-opacity-90 transition-all duration-200 shadow hover:shadow-md transform hover:scale-105">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Save {{ $roleLabel }} Permissions
                    </button>
                </div>
            </form>
        </div>
        @endforeach
    </div>

    {{-- Legend --}}
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 px-6 py-4">
        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Permission Legend</p>
        <div class="flex flex-wrap gap-3">
            <span class="flex items-center gap-2 text-xs font-medium text-blue-700 bg-blue-50 border border-blue-200 px-3 py-1.5 rounded-lg">
                <span class="w-2 h-2 rounded-full bg-blue-500"></span> View — Read access
            </span>
            <span class="flex items-center gap-2 text-xs font-medium text-green-700 bg-green-50 border border-green-200 px-3 py-1.5 rounded-lg">
                <span class="w-2 h-2 rounded-full bg-green-500"></span> Create — Add new records
            </span>
            <span class="flex items-center gap-2 text-xs font-medium text-amber-700 bg-amber-50 border border-amber-200 px-3 py-1.5 rounded-lg">
                <span class="w-2 h-2 rounded-full bg-amber-500"></span> Edit — Modify existing records
            </span>
            <span class="flex items-center gap-2 text-xs font-medium text-red-700 bg-red-50 border border-red-200 px-3 py-1.5 rounded-lg">
                <span class="w-2 h-2 rounded-full bg-red-500"></span> Delete — Remove records
            </span>
        </div>
    </div>
</div>

<script>
function toggleAll(role, state) {
    document.querySelectorAll(`.perm-checkbox[data-role="${role}"]`).forEach(cb => cb.checked = state);
    document.querySelectorAll(`.module-toggle[data-role="${role}"]`).forEach(cb => {
        cb.checked = state;
        cb.indeterminate = false;
    });
}

function toggleModule(role, module, state) {
    document.querySelectorAll(`.perm-checkbox[data-role="${role}"][data-module="${module}"]`)
        .forEach(cb => cb.checked = state);
}

function syncModuleToggle(role, module) {
    const boxes  = [...document.querySelectorAll(`.perm-checkbox[data-role="${role}"][data-module="${module}"]`)];
    const toggle = document.querySelector(`.module-toggle[data-role="${role}"][data-module="${module}"]`);
    if (!toggle) return;
    const all  = boxes.every(cb => cb.checked);
    const none = boxes.every(cb => !cb.checked);
    toggle.checked       = all;
    toggle.indeterminate = !all && !none;
}

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.module-toggle').forEach(t =>
        syncModuleToggle(t.dataset.role, t.dataset.module)
    );
});
</script>
@endsection
