
<div class='page-content'>
  
<?php

  $position = engine::user("profile","position");

  if(empty($data["App"]['relate'])) {
    $assignment = false;
  } else {
    $assignment = true;
  }

  foreach ($data["App"]['dashboard'] as $FrontEnd)
  {
    if (empty($FrontEnd["application"]['detail'])) // No Application
    {
      if($FrontEnd['app_visible']=="1")
      {
        $notRegis .=
        "<div class='card card-style'>
          <div class='card-body ml-1 mr-1'>
              <p class='mb-0 color-highlight font-600 mt-3'>ใบสมัคร</p>
              <h1 class='font-30 font-800 mb-3'>{$FrontEnd['app_name']}</h1>
              <p class='opacity-50 line-height-s font-12'>{$FrontEnd['app_desc']}</p>
              <div class='divider'></div>              
              <a href='javascript:void(0);' class='btn btn-full btn-m font-600 rounded-sm gradient-highlight mb-3' onclick='page(\"app/create/{$FrontEnd['app_token']}\");'>สมัครตอนนี้</a>
          </div>       
        </div>";
      }

    }
    else // Have Application
    {
      
      $first_formset         = $FrontEnd["first"];
      $check_document        = $FrontEnd["check_document"];
      $check_form            = $FrontEnd["check_form"];
      $document_percent      = $FrontEnd["document_percent"];
      $form_percent          = $FrontEnd["form_percent"];
      $application_percent   = $FrontEnd["application_percent"];
      $fillCheck             = $FrontEnd["formResult"];

      if($FrontEnd['app_type']=="form")
      {
        $btn = "
        <div class='card-footer'>
          <div class='d-flex' role='group'>
            <button class='theme-btn mr-2' onclick='page(\"app/fill/{$FrontEnd["application"]['detail']['ap_token']}/{$first_formset}/member\");'><i class='mdi mdi-square-edit-outline'></i> ทำแบบประเมิน</button>
            <button class='theme-btn mr-2' onclick='page(\"app/assumption/result\");'><i class='mdi mdi-square-edit-outline'></i> ผลลัพธ์</button>
          </div>
        </div>";
      }
      else
      {

        if($FrontEnd['linkage']['app_id']!="" || $FrontEnd['linkage']['app_id']!=NULL)
        {
          $btn = "
          <div class='card-footer'>
            <div class='d-flex' role='group'>
              <button class='theme-btn mr-2' onclick='page(\"app/fill/{$FrontEnd["application"]['detail']['ap_token']}/{$first_formset}\");'><i class='mdi mdi-square-edit-outline'></i> กรอกใบสมัคร</button>
              <button class='theme-btn mr-2' onclick='page(\"app/fill/{$FrontEnd["linkage_app"]['detail']['ap_token']}/{$FrontEnd['linkage_first']}\");'><i class='mdi mdi-square-edit-outline'></i> ประเมิน</button>
              <button class='btn btn-default mr-2' onclick='page(\"app/upload/{$FrontEnd["application"]['detail']['ap_token']}\");'><i class='mdi mdi-file-upload-outline'></i> อัพโหลดเอกสาร</button>
              <button class='btn btn-default mr-2' onclick='page(\"app/detail/{$FrontEnd["application"]['detail']['ap_token']}\");'><i class='mdi mdi-content-paste'></i> รายละเอียด</button>
              <!--button class='btn btn-dark mr-2' onclick='removeApp(\"{$FrontEnd["application"]['detail']['ap_token']}\");'><i class='mdi mdi-delete'></i> ยกเลิก</button>-->
            </div>
          </div>";
        }
        else
        {
          $btn = "
          <div class='card-footer'>
            <div class='d-flex' role='group'>
              <button class='theme-btn mr-2' onclick='page(\"app/fill/{$FrontEnd["application"]['detail']['ap_token']}/{$first_formset}\");'><i class='mdi mdi-square-edit-outline'></i> กรอกใบสมัคร</button>
              <button class='btn btn-default mr-2' onclick='page(\"app/upload/{$FrontEnd["application"]['detail']['ap_token']}\");'><i class='mdi mdi-file-upload-outline'></i> อัพโหลดเอกสาร</button>
              <button class='btn btn-default mr-2' onclick='page(\"app/detail/{$FrontEnd["application"]['detail']['ap_token']}\");'><i class='mdi mdi-content-paste'></i> รายละเอียด</button>
              <!--button class='btn btn-dark mr-2' onclick='removeApp(\"{$FrontEnd["application"]['detail']['ap_token']}\");'><i class='mdi mdi-delete'></i> ยกเลิก</button>-->
            </div>
          </div>";
        }
        
      }

      if(count($FrontEnd["application"]['message']) == 0)
      {
        $message_count = "0";
        $message_alert = "";
      }
      else
      {
        if($FrontEnd["application"]['messageCount']>0)
        {
          $message_count = count($FrontEnd["application"]['message']);
          $message_alert = "
          <span class='message-btn' onclick='page(\"app/message/{$FrontEnd["application"]['detail']['ap_token']}\");'>
          <span class='message-label'>{$FrontEnd["application"]['messageCount']}</span>
          <span class='message-icon'><i class='mdi mdi-email'></i></span>
          </span>
          ";
        }
        else
        {
          $message_alert = "";
          $message_count = "0";
        }
      }

      $doRegis .=
      "
      <div class='card card-style'>
          <div class='card-body ml-1 mr-1'>
              <p class='mb-0 color-highlight font-600 mt-3'>ใบสมัคร</p>
              <h1 class='font-30 font-800 mb-3'>{$FrontEnd['app_name']}</h1>
              <p class='opacity-50 line-height-s font-12'>{$FrontEnd['app_desc']}</p>
              <div class='divider'></div>
              <div class='d-flex'>
                  <div>
                      <h3 class='mb-0'>สถานะเอกสาร</h3>
                      <p class='opacity-50 line-height-s font-12'>{$check_document['list']} {$check_document['message']}</p>
                  </div>
                  <div class='ml-auto pl-3'>
                      <h4>{$check_document['percent']}%</h4>
                  </div>
              </div>
              
              <div class='d-flex'>
                  <div>
                      <h3 class='mb-0'>แบบฟอร์ม</h3>
                      <p class='opacity-50 line-height-s font-12'>{$check_form['overview']['message']}</p>
                  </div>
                  <div class='ml-auto pl-3'>
                      <h4>{$check_form['overview']['percent']}%</h4>
                  </div>
              </div>                
              <a href='javascript:void(0);' class='btn btn-m btn-full mb-3 rounded-xs text-uppercase font-900 shadow-s bg-green-dark' onclick='page(\"remote/fill/{$FrontEnd["application"]['detail']['ap_token']}/{$first_formset}\");'>แก้ไขใบสมัคร</a>
          </div>       
      </div>
      ";
    }
  }

  echo "
  <div class='card card-style bg-green-dark rounded-s'>
    <h4 class='py-3 px-3 font-500 font-14 mb-0 color-white'>ใบสมัครของคุณ <i class='fa fa-check-circle pt-1 font-13 float-right'></i></h4>
  </div>";

  echo $doRegis;

  echo "
  <div class='card card-style bg-dark-light rounded-s'>
    <h4 class='py-3 px-3 font-500 font-14 mb-0 color-white'>ใบสมัครที่ยังไม่ได้ลงทะเบียน <i class='fa fa-plus pt-1 font-13 float-right'></i></h4>
  </div>";

  echo $notRegis;
  ?>

</div>