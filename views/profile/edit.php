<form action="profile-update.php" method="POST" enctype="multipart/form-data">
    <div class="space-y-6">
    <div class="space-y-2">
        <div class="flex items-center text-gray-500 text-sm font-medium">
        <i class="fas fa-user-circle mr-2 text-indigo-500"></i>
        Username
        </div>
        <input type="text" 
        name="edit_username" 
        class="p-4 text-sm bg-gray-50 rounded-lg border-2 border-gray-200 w-full focus:ring-2 focus:ring-indigo-500 outline-none"
        value="<?= htmlspecialchars($user['username']) ?>" 
        />
    </div>

    <!-- Email -->
    <div class="space-y-2">
        <div class="flex items-center text-gray-500 text-sm font-medium">
        <i class="fas fa-envelope mr-2 text-indigo-500"></i>
        Email Address
        </div>
        <input type="email" 
        name="edit_email" 
        class="p-4 text-sm bg-gray-50 rounded-lg border-2 border-gray-200 w-full focus:ring-2 focus:ring-indigo-500 outline-none"
        value="<?= htmlspecialchars($user['email']) ?>" 
        />
    </div>

    <!-- Bio -->
    <div class="space-y-2">
        <div class="flex items-center text-gray-500 text-sm font-medium">
        <i class="fas fa-info-circle mr-2 text-indigo-500"></i>
        Bio
        </div>
        <input type="text" 
        name="edit_bio" 
        class="p-4 text-sm bg-gray-50 rounded-lg border-2 border-gray-200 w-full focus:ring-2 focus:ring-indigo-500 outline-none"
        value="<?= htmlspecialchars($user['bio']) ?>" 
        />
    </div>
    </div>
    <div class="flex justify-start mt-5 gap-4">
    <a href="profile.php" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-medium">Cancel</a>
    <button type="submit" class="px-5 py-2 bg-indigo-600 text-white rounded-lg cursor-pointer hover:bg-indigo-700 font-medium">Save</button>
    </div>
</form>