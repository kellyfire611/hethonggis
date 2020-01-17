<?php

Breadcrumbs::for('admin.dashboard', function ($trail) {
    $trail->push(__('strings.backend.dashboard.title'), route('admin.dashboard'));
});

require __DIR__.'/auth.php';
require __DIR__.'/log-viewer.php';

// Page
Breadcrumbs::for('admin.pages.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Trang', route('admin.pages.index'));
});

Breadcrumbs::for('admin.pages.deleted', function ($trail) {
    $trail->parent('admin.pages.index');
    $trail->push('Trang đã xóa', route('admin.pages.deleted'));
});

Breadcrumbs::for('admin.pages.create', function ($trail) {
    $trail->parent('admin.pages.index');
    $trail->push('Thêm mới Trang', route('admin.pages.create'));
});

Breadcrumbs::for('admin.pages.show', function ($trail, $id) {
    $trail->parent('admin.pages.index');
    $trail->push('Xem Trang', route('admin.pages.show', $id));
});

Breadcrumbs::for('admin.pages.edit', function ($trail, $id) {
    $trail->parent('admin.pages.index');
    $trail->push('Sửa Trang', route('admin.pages.edit', $id));
});

// Quảng cáo
Breadcrumbs::for('admin.quangcaos.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Quảng cáo', route('admin.quangcaos.index'));
});

Breadcrumbs::for('admin.quangcaos.deleted', function ($trail) {
    $trail->parent('admin.quangcaos.index');
    $trail->push('Quảng cáo đã xóa', route('admin.quangcaos.deleted'));
});

Breadcrumbs::for('admin.quangcaos.create', function ($trail) {
    $trail->parent('admin.quangcaos.index');
    $trail->push('Thêm mới Quảng cáo', route('admin.quangcaos.create'));
});

Breadcrumbs::for('admin.quangcaos.show', function ($trail, $id) {
    $trail->parent('admin.quangcaos.index');
    $trail->push('Xem Quảng cáo', route('admin.quangcaos.show', $id));
});

Breadcrumbs::for('admin.quangcaos.edit', function ($trail, $id) {
    $trail->parent('admin.quangcaos.index');
    $trail->push('Sửa Quảng cáo', route('admin.quangcaos.edit', $id));
});

// Tỉnh thành
Breadcrumbs::for('admin.tinhthanh.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Tỉnh thành', route('admin.tinhthanh.index'));
});

Breadcrumbs::for('admin.tinhthanh.deleted', function ($trail) {
    $trail->parent('admin.tinhthanh.index');
    $trail->push('Tỉnh thành đã xóa', route('admin.tinhthanh.deleted'));
});

Breadcrumbs::for('admin.tinhthanh.create', function ($trail) {
    $trail->parent('admin.tinhthanh.index');
    $trail->push('Thêm mới Tỉnh thành', route('admin.tinhthanh.create'));
});

Breadcrumbs::for('admin.tinhthanh.show', function ($trail, $id) {
    $trail->parent('admin.tinhthanh.index');
    $trail->push('Xem Tỉnh thành', route('admin.tinhthanh.show', $id));
});

Breadcrumbs::for('admin.tinhthanh.edit', function ($trail, $id) {
    $trail->parent('admin.tinhthanh.index');
    $trail->push('Sửa Tỉnh thành', route('admin.tinhthanh.edit', $id));
});

// Địa điểm
Breadcrumbs::for('admin.diadiem.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Địa điểm', route('admin.diadiem.index'));
});

Breadcrumbs::for('admin.diadiem.deleted', function ($trail) {
    $trail->parent('admin.diadiem.index');
    $trail->push('Địa điểm đã xóa', route('admin.diadiem.deleted'));
});

Breadcrumbs::for('admin.diadiem.create', function ($trail) {
    $trail->parent('admin.diadiem.index');
    $trail->push('Thêm mới Địa điểm', route('admin.diadiem.create'));
});

Breadcrumbs::for('admin.diadiem.show', function ($trail, $id) {
    $trail->parent('admin.diadiem.index');
    $trail->push('Xem địa điểm', route('admin.diadiem.show', $id));
});

Breadcrumbs::for('admin.diadiem.edit', function ($trail, $id) {
    $trail->parent('admin.diadiem.index');
    $trail->push('Sửa địa điểm', route('admin.diadiem.edit', $id));
});

