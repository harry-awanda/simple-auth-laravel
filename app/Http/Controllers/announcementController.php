<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class announcementController extends Controller {
  public function index() {
    $announcements = Announcement::orderBy('created_at', 'desc')->get();
			return view('admin.announcement.index', compact('announcements'));
  }

  public function store(Request $request) {
		$request->validate([
			'title' => 'required',
			'content' => 'required',
		]);
		
		Announcement::create([
			'title' => $request->title,
			'content' => $request->content,
			'author' => Auth::user()->role,
		]);
		
		return redirect()->route('announcement.index')->with('success', 'Announcement created successfully.');
  }

  public function edit(Announcement $announcement) {
    return view('admin.announcement.edit', compact('announcement'));
  }

  public function update(Request $request, Announcement $announcement) {
		$request->validate([
			'title' => 'required',
			'content' => 'required',
		]);

		$announcement->update([
			'title' => $request->title,
			'content' => $request->content,
			'author' => Auth::user()->role, // Add this line
		]);

		return redirect()->route('announcement.index')->with('success', 'Announcement updated successfully.');
    }

  public function destroy(Announcement $announcement) {
		$announcement->delete();
		return redirect()->route('announcement.index')->with('success', 'Announcement deleted successfully.');
	}
}