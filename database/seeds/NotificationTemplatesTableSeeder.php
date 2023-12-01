<?php

use Illuminate\Database\Seeder;

class NotificationTemplatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 2],['title' => 'Nueva insignia','template' => '<p>Recibiste la insignia [u.b.title]</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 3],['title' => 'Cambio en grupo de usuarios','template' => '<p>Tu grupo cambia a [u.g.title]</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 4],['title' => 'Curso creado','template' => '<p>Creaste un nuevo curso con título [c.title]</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 5],['title' => 'Curso aprobado','template' => '<p>Tu curso con título [c.title] fue aprobado.</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 6],['title' => 'Curso rechazado','template' => '<p>Su curso con título [c.title] fue rechazado</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 7],['title' => 'Nuevo comentario','template' => '<p>El usuario [u.name] agregó un nuevo comentario para el curso con el título [c.title]</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 8],['title' => 'Nuevo mensaje de soporte','template' => '<p>El usuario [u.name] envió un nuevo mensaje de soporte para el curso con el título [c.title]</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 9],['title' => 'Mensaje de soporte respondido','template' => '<p>Mensaje de soporte respondido para el curso [c.title]</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 10],['title' => 'Nuevo soporte para administrador','template' => '<p>Enviar nuevo ticket de soporte con título&nbsp;[s.t.title]</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 11],['title' => 'Ticket de soporte respondido por el administrador','template' => '<p>respondió ticket de soporte con título&nbsp;[s.t.title]</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 12],['title' => 'Nuevo documento financiero','template' => '<p>&nbsp;Nuevo documento financiero para el curso [c.title] de tipo [f.d.type] con precio [amount]</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 13],['title' => 'Solicitud de pago','template' => '<p>Solicitud de pago por monto de [payout.amount]</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 14],['title' => 'Proceder al pago','template' => '<p>Pago con monto [payout.amount] proceder por cuenta [payout.account]</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 15],['title' => 'Nuevas ventas','template' => '<p>Nueva venta&nbsp;del curso [c.title]</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 16],['title' => 'Nueva compra','template' => '<p>Nueva compra del curso [c.title]</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 17],['title' => 'Calificación (Comentarios)','template' => '<p>Nuevos comentarios enviados para el curso con título [c.title] del estudiante [student.name] y calificación [rate.count]</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 18],['title' => 'Solicitud de pago fuera de línea','template' => '<p>Solicitud de pago fuera de línea por [amount]</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 19],['title' => 'Pago fuera de línea aprobado','template' => '<p>Solicitud de pago fuera de línea por [amount] fue aprobado</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 20],['title' => 'Pago sin conexión rechazado','template' => '<p>Solicitud de pago fuera de línea por [amount] fue rechazado.</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 21],['title' => 'Nuevo plan de suscripción','template' => '<p>Nuevo plan de suscripción activado por el usuario [u.name] para el plan [s.p.name]</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 22],['title' => 'Nueva cita','template' => '<p>Nueva cita reservada por el usuario [u.name] a las [time.date] con precio de [amount]</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 23],['title' => 'Nuevo link de cita','template' => '<p>Link de cita definido por [instructor.name]. hora [time.date] y el link es [link]</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 24],['title' => 'Recordatorio de cita','template' => '<p>Tiene una cita el [time.date]</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 25],['title' => 'Reunión finalizada','template' => '<p>Reunión finalizada, instructor : [instructor.name] y estudiante : [student.name] y hora : [time.date]</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 26],['title' => 'Nuevo mensaje de contacto','template' => '<p>Nuevo mensaje de contacto&nbsp;recibido con título [c.u.title] y nombre de usuario [u.name]</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 27],['title' => 'Recordatorio del curso','template' => '<p>Hora de recordatorio del curso [time.date] título del curso [c.title]</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 28],['title' => 'Plan de promoción','template' => '<p>Plan [p.p.name]&nbsp;activado para el curso [c.title]</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 29],['title' => 'Plan de promoción para administrador','template' => '<p>Nueva solicitud de plan de promoción de [p.p.name] para el curso [c.title]</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 30],['title' => 'Certificado','template' => '<p>Certificado recibido del curso [c.title]</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 31],['title' => 'Esperando quiz','template' => '<p>El estudiante [student.name] está esperando prueba [q.title] para el curso [c.title]</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 32],['title' => 'Esperando el resultado de la prueba','template' => '<p>Curso [c.title]&nbsp;prueba calculada por el instructor [q.title] resultado [q.result].</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 33],['title' => 'Nueva venta de producto','template' => '<p>Nueva venta de producto de título [p.title]</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 34],['title' => 'Nueva compra de producto','template' => '<p>Nueva compra de producto con título [p.title]</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 35],['title' => 'Nuevo comentario de producto','template' => '<p>El usuario [u.name] agrega un nuevo comentario para el producto con el título [p.title]</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 36],['title' => 'Código de seguimiento del producto','template' => '<p>El usuario [u.name] agrega el código de seguimiento para el producto con el título [p.title]</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 37],['title' => 'Calificación del producto (Comentarios)','template' => '<p>Nuevos comentarios enviados para el producto con título [p.title] por el usuario [u.name] y con calificación de [rate.count]</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 38],['title' => 'Recibir envío de producto','template' => '<p>El usuario [u.name] recibió un producto con el título [p.title]</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 39],['title' => 'Producto agotado','template' => '<p>El producto [p.title] se agotó en el inventario.</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 40],['title' => 'Enviar la tarea del estudiante al instructor','template' => '<p>[student.name] enviar tarea para el curso que tiene por título [c.title]</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 41],['title' => 'Cuando el instructor envía un mensaje para asignación','template' => '<p>[instructor.name] envía mensaje para el curso por título [c.title]</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 42],['title' => 'Calificación de la tarea','template' => '<p>El [instructor.name] le otorgó una calificación de [assignment_grade]&nbsp;para el curso por título [c.title]</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 43],['title' => 'Acceso del usuario al contenido','template' => '<p>Su acceso al contenido está habilitado.</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 44],['title' => 'Enviar publicación en el tema','template' => '<p>[u.name] envía una publicación en tu tema con el título [topic_title]&nbsp;</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 45],['title' => 'Publicado en el blog del instructor','template' => '<p>Tu publicación con el título [blog_title] fue publicada.</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 46],['title' => 'Nuevo comentario para el blog del instructor','template' => '<p>Usuario [u.name] agregue un nuevo comentario para su blog con el título [blog_title]</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 47],['title' => 'Recordatorio de reunión','template' => '<p>Hora de recordatorio de la reunión [time.date] con el nombre del instructor [instructor.name]</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 48],['title' => 'Recordatorio de caducidad de suscripción','template' => '<p>Su suscripción caducó el [time.date]</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 49],['title' => 'Nueva pregunta en foro del curso','template' => '<p>[u.name] registró una pregunta en el foro del curso [c.title].</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 50],['title' => 'Nueva respuesta en el foro del curso.','template' => '<p>[u.name] registró una respuesta en el foro del curso [c.title].</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 52],['title' => 'Recibiste un regalo','template' => '<p>[u.name]&nbsp;te envió [gift_title] que es un [gift_type]&nbsp;como regalo con el siguiente mensaje: [gift_message]</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 53],['title' => 'Regalo enviado correctamente','template' => '<p>Su solicitud de regalo para [u.name] enviada correctamente el [time.date] y el [gift_title] que es un [gift_type] por [amount] se enviará al destinatario el [time.date.2] con el siguiente mensaje: [gift_message]</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 54],['title' => 'Regalo enviado al destinatario','template' => '<p>Enviamos la solicitud de regalo que envió el [time.date]&nbsp;para [u.name]. Enviamos [gift_title] que es un [gift_type]&nbsp;al destinatario con el siguiente mensaje el [time.date]. [gift_message]</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 55],['title' => 'Solicitud de regalo enviada (Administrador)','template' => '<p>[u.name.2] envió una solicitud de regalo para [gift_title]&nbsp;que es un [gift_type]&nbsp;para [u.name]&nbsp;el [time.date]&nbsp;por [amount]&nbsp;y se enviará al destinatario el [time.date.2]</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 56],['title' => 'Regalo enviado al destinatario (Administrador)','template' => '<p>El sistema envió un [gift_title]&nbsp;que es un [gift_type]&nbsp;a [u.name]&nbsp;el [time.date.2]&nbsp;con éxito. [u.name.2]&nbsp;envió esta solicitud el [time.date]&nbsp;por [amount].</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 57],['title' => 'Tienes una próxima entrega','template' => '<p>Tiene una cuota de [installment_title] por [amount]&nbsp;con fecha de vencimiento [time.date]</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 58],['title' => 'Tienes una cuota sin pagar','template' => '<p>Tienes una cuota de [installment_title]&nbsp;por [amount]&nbsp;para hoy. Pague lo antes posible.</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 59],['title' => 'Tienes una cuota vencida','template' => '<p>Tiene una cuota vencida de [installment_title]&nbsp;por [amount]&nbsp;con fecha de vencimiento [time.date].</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 60],['title' => 'Solicitud de verificación de cuotas aprobada','template' => '<p>Se aprobó su solicitud de verificación para [installment_title].</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 61],['title' => 'Solicitud de verificación de cuotas rechazada','template' => '<p>Su solicitud de verificación para [installment_title]&nbsp;rechazada.</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 62],['title' => 'Cuota pagada con éxito','template' => '<p>Pagó&nbsp;con éxito [amount]&nbsp;por [installment_title]&nbsp;con fecha de vencimiento [time.date].</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 63],['title' => 'Cuota pagada con éxito (Administrador)','template' => '<p>[u.name] pagó correctamente [amount] por [installment_title] con la fecha de vencimiento [time.date].</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 64],['title' => 'Cantidad pagada por adelantado a cuotas','template' => '<p>Pagó [amount] por adelantado por&nbsp;[installment_title].</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 65],['title' => 'Solicitud de verificación de cuotas enviada','template' => '<p>Recibimos su solicitud de verificación para [installment_title]&nbsp;el [time.date]&nbsp;y pronto le informaremos el resultado.</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 66],['title' => 'Solicitud de verificación de cuotas enviada (Administrador)','template' => '<p>[u.name] envió una solicitud de verificación para [installment_title]&nbsp;el [time.date].</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 67],['title' => 'Solicitud de cuota enviada','template' => '<p>Su cuota de [installment_title] por [amount] se envió correctamente.</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 68],['title' => 'Solicitud de cuota enviada (Administrador)','template' => '<p>[u.name] envió una solicitud de pago en cuotas para [installment_title] por [amount].</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 69],['title' => 'Nuevo curso próximo enviado','template' => '<p>Tu próximo curso [item_title]&nbsp;se envió correctamente.</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 70],['title' => 'Nuevo curso próximo enviado (administrador)','template' => '<p>[u.name] envió un próximo curso con el título [item_title].</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 71],['title' => 'Próximo curso aprobado','template' => '<p>Su próximo curso [item_title] fue aprobado.</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 72],['title' => 'Próximo curso rechazado','template' => '<p>Tu próximo curso [item_title] fue rechazado.</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 73],['title' => 'Tu próximo curso publicado','template' => '<p>Tu próximo curso [item_title] está publicado.</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 74],['title' => 'Tu próximo curso es seguido','template' => '<p>[u.name] siguió su próximo curso [item_title]</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 75],['title' => 'Próximo curso publicado y accesible','template' => '<p>El próximo curso [item_title] se publicó ahora y puedes consultarlo.</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 76],['title' => '¡Obtuviste un reembolso!','template' => '<p>Obtuvo [amount] como reembolso y esta cantidad se agregó a su cuenta.</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 77],['title' => 'El usuario obtuvo un reembolso (Administrador)','template' => '<p>[u.name] obtuvo [amount] como reembolso y esta cantidad se cargó a su cuenta.</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 78],['title' => 'Paquete enviado con éxito','template' => '<p>Su paquete con el título [item_title]&nbsp;se envió correctamente..</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 79],['title' => 'Paquete enviado (administrador)','template' => '<p>[u.name] envió un paquete con el título [item_title].</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 80],['title' => 'Paquete publicado con éxito','template' => '<p>Su paquete con el título [item_title]&nbsp;se publicó correctamente.</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 81],['title' => 'Paquete rechazado','template' => '<p>Su paquete con título [item_title] fue rechazado.</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 82],['title' => 'Nueva revisión para su paquete','template' => '<p>[u.name] envió una calificación de [rate.count] estrellas para su paquete [item_title].</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 83],['title' => 'Tienes bono de registro','template' => '<p>Obtuviste [amount]&nbsp;como bono de registro.</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 84],['title' => 'Bono de registro desbloqueado.','template' => '<p>Su bono de registro [amount] desbloqueado.</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 85],['title' => 'Bono de registro desbloqueado (Administrador)','template' => '<p>El bono de registro [amount] está desbloqueado para [u.name].</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 86],['title' => 'Paquete SaaS activado con éxito','template' => '<p>[item_title] activado para usted hasta [time.date].</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 87],['title' => 'Paquete SaaS activado (Administrador)','template' => '<p>[u.name] activó el plan de registro de [item_title] hasta el [time.date].</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 88],['title' => 'Su mensaje de contacto fue enviado','template' => '<p>Recibimos su mensaje de contacto con el asunto [c.u.title]&nbsp;el [time.date].</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 89],['title' => 'Nuevo mensaje de contacto recibido','template' => '<p>Nuevo mensaje de contacto recibido de [u.name] con asunto [c.u.title] con mensaje [c.u.message]</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 90],['title' => 'Te enviaste a la lista de espera','template' => '<p>Te enviaste a la lista de espera [c.title].</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 91],['title' => 'Usuario enviado en lista de espera','template' => '<p>[u.name] enviado a la&nbsp;lista de espera [c.title].</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 92],['title' => 'Nuevo usuario registrado con su código de afiliado','template' => '<p>[u.name] registrado con su código de afiliado el [time.date].</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 93],['title' => 'Nuevo cuestionario agregado al curso','template' => '<p>Nuevo cuestionario con el título [q.title] agregado al curso [c.title].</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 94],['title' => 'Nuevo punto de recompensa','template' => '<p>Obtienes [points]&nbsp;por [item_title]&nbsp;el [time.date]</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 95],['title' => 'Nuevo aviso','template' => '<p>Tienes un nuevo aviso con título [c.title]&nbsp;a las [time.date]</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 96],['title' => 'Nuevo aviso de curso','template' => '<p>Tienes un nuevo aviso de curso de [c.title]&nbsp;con título [item_title]</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 97],['title' => 'Tu rol de usuario cambió','template' => '<p>Su rol de usuario cambió a [u.role]</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 98],['title' => 'Nuevo grupo de usuarios','template' => '<p>Se agregó al grupo de usuarios de [u.g.title].</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 99],['title' => 'Solicitud de convertirse en instructor/organización aprobada','template' => '<p>Se aprobó su solicitud para convertirse en instructor/organización.</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 100],['title' => 'Solicitud de convertirse en instructor/organización rechazada','template' => '<p>Su solicitud de instructor/organización rechazada</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 101],['title' => 'Nueva pregunta en el foro del curso.','template' => '<p>[u.name] publicó una nueva pregunta en el foro [c.title].</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 102],['title' => 'Nueva respuesta en el foro del curso.','template' => '<p>[u.name] publicó una nueva respuesta en el foro [c.title].</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 103],['title' => 'Reunión en vivo creada','template' => '<p>[instructor.name] comenzó una nueva reunión en vivo. Inicie sesión en su cuenta y únase ahora...</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 104],['title' => 'Nuevo usuario registrado','template' => '<p>[u.name] registrado en la plataforma a las [time.date]&nbsp;como [u.role]</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 105],['title' => 'Nueva solicitud de instructor/organización','template' => '<p>[u.name] envió una solicitud de cambio de rol de usuario a las [time.date]</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 106],['title' => 'Nueva matrícula a curso','template' => '<p>[u.name] matriculado en [c.title]&nbsp;a las [time.date]&nbsp;por [amount].</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 107],['title' => 'Nuevo tema del foro','template' => '<p>[u.name]creó un nuevo tema con el título [topic_title]&nbsp;en el foro [forum_title].</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 108],['title' => 'Nuevo reporte','template' => '<p>[u.name] envió una revisión de contenido para su revisión.</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 109],['title' => 'Nuevo item creado','template' => '<p>[u.name] creó un nuevo item con título [item_title]</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 110],['title' => 'Nuevo pedido de tienda','template' => '<p>Nuevo pedido de tienda recibido de [u.name]&nbsp;por [amount]</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 111],['title' => 'Plan de suscripción activado','template' => '<p>[u.name] compró [s.p.name]&nbsp;a [amount]</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 112],['title' => 'Solicitud de revisión de contenido','template' => '<p>[u.name] envió una solicitud de revisión para [item_title]</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 113],['title' => 'Nueva publicación de blog de usuario','template' => '<p>[u.name] envió un artículo de blog con título [blog_title]</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 114],['title' => 'Revisión de nuevo item (Clasificación)','template' => '<p>[u.name] presentó una nueva tarifa para [item_title]</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 115],['title' => 'Nuevo usuario de la organización','template' => '<p>[organization.name] presentó a [u.name]&nbsp;como nuevo [u.role]</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 116],['title' => 'Cargo de billetera de usuario','template' => '<p>[u.name] cargó su billetera por [amount]</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 117],['title' => 'Nueva solicitud de pago','template' => '<p>[u.name] envió una nueva solicitud de pago de [amount]</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 118],['title' => 'Nueva solicitud de pago sin conexión','template' => '<p>[u.name] envió una nueva solicitud de pago fuera de línea de [amount]</p>']);
        \App\Models\NotificationTemplate::updateOrCreate(['id' => 119],['title' => 'Aprobación de acceso al contenido','template' => '<p>Se aprobó su solicitud de acceso al contenido. Ya puedes acceder a todos los cursos...</p>']);
    }
}
