@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <h1 class="display-4 mb-4">ยินดีต้อนรับสู่ระบบ HR</h1>
            <p class="lead mb-5">ระบบจัดการทรัพยากรบุคคลแบบครบวงจร</p>
            
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <i class="fas fa-users fa-2x text-primary mb-3"></i>
                            <h5 class="card-title">จัดการพนักงาน</h5>
                            <p class="card-text">ดูข้อมูล เพิ่ม แก้ไข และจัดการข้อมูลพนักงาน</p>
                            <a href="{{ route('hr.index') }}" class="btn btn-primary">
                                <i class="fas fa-arrow-right me-2"></i>เข้าสู่ระบบ
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <i class="fas fa-file-upload fa-2x text-success mb-3"></i>
                            <h5 class="card-title">อัพโหลดข้อมูล</h5>
                            <p class="card-text">นำเข้าข้อมูลพนักงานผ่านไฟล์ CSV</p>
                            <a href="{{ route('hr.upload') }}" class="btn btn-success">
                                <i class="fas fa-upload me-2"></i>อัพโหลด
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    transition: transform 0.2s;
}
.card:hover {
    transform: translateY(-5px);
}
.fa-2x {
    font-size: 2.5rem;
}
</style>
@endsection 