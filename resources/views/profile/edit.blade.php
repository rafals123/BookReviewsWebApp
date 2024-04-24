<x-app-layout>

    <style>
        .form {
            background: linear-gradient(45deg, #B9A540, #9C6A29, #AE4B0A);  
            
        }
        .form label, .form span {
            color: white;
            
        }
        
     
    </style>
    <div class="py-12 " style="background-color: #8A6926;" >
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg form">
                <div class="max-w-xl mx-auto text-center">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg form ">
                <div class="max-w-xl mx-auto text-center">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg form">
                 <div class="max-w-xl mx-auto text-center">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
