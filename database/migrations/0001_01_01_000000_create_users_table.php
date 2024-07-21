<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up(): void
	{
		if (!Schema::hasTable('users')) {
			Schema::create('users', function (Blueprint $table) {
				$table->id();
				$table->text('name');
				$table->text('email'); // Encrypted email
				$table->string('email_hash')->unique(); // Hashed email for unique validation
				$table->string('password');
				$table->unsignedTinyInteger('role')->default(2)->comment("0=Admin,1=Organizer,2=Attendee"); // Default to attendee
				$table->timestamp('email_verified_at')->nullable();
				$table->rememberToken();
				$table->timestamps();
			});
		}

		if (!Schema::hasTable('password_reset_tokens')) {
			Schema::create('password_reset_tokens', function (Blueprint $table) {
				$table->string('email')->primary();
				$table->string('token');
				$table->timestamp('created_at')->nullable();
			});
		}

		if (!Schema::hasTable('sessions')) {
			Schema::create('sessions', function (Blueprint $table) {
				$table->string('id')->primary();
				$table->foreignId('user_id')->nullable()->index();
				$table->string('ip_address', 45)->nullable();
				$table->text('user_agent')->nullable();
				$table->longText('payload');
				$table->integer('last_activity')->index();
			});
		}
	}

	public function down(): void
	{
		Schema::dropIfExists('users');
		Schema::dropIfExists('password_reset_tokens');
		Schema::dropIfExists('sessions');
	}
};