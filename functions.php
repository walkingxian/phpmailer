/*�����ʼ�����
 *@param $to�������� $title������ $content���ʼ�����
 *@return bool true:���ͳɹ� false:����ʧ��
 */

function sendMail($to,$title,$content){

    //����PHPMailer�ĺ����ļ� ʹ��require_once�����������PHPMailer���ظ�����ľ���
    require_once("phpmailer/class.phpmailer.php"); 
    require_once("phpmailer/class.smtp.php");
    //ʵ����PHPMailer������
    $mail = new PHPMailer();

    //�Ƿ�����smtp��debug���е��� �����������鿪�� ��������ע�͵����� Ĭ�Ϲر�debug����ģʽ
    $mail->SMTPDebug = 1;

    //ʹ��smtp��Ȩ��ʽ�����ʼ�
    $mail->isSMTP();

    //smtp��Ҫ��Ȩ ���������true
    $mail->SMTPAuth=true;

    //����qq��������ķ�������ַ
    $mail->Host = 'smtp.qq.com';

    //����ʹ��ssl���ܷ�ʽ��¼��Ȩ
    $mail->SMTPSecure = 'ssl';

    //����ssl����smtp��������Զ�̷������˿ںţ���ǰ��Ĭ����25�����������µĺ����Ѿ��������� ��ѡ465��587
    $mail->Port = 465;

    //����smtp��helo��Ϣͷ ������п��� ��������
    // $mail->Helo = 'Hello smtp.qq.com Server';

    //���÷����˵������� ���п��� Ĭ��Ϊlocalhost �������⣬����ʹ���������
    $mail->Hostname = 'http://www.lsgogroup.com';

    //���÷��͵��ʼ��ı��� ��ѡGB2312 ��ϲ��utf-8 ��˵utf8��ĳЩ�ͻ��������»�����
    $mail->CharSet = 'UTF-8';

    //���÷������������ǳƣ� �������ݣ���ʾ���ռ����ʼ��ķ����������ַǰ�ķ���������
    $mail->FromName = 'LSGOʵ����';

    //smtp��¼���˺� ���������ַ�����ʽ��qq�ż���
    $mail->Username ='12345678@qq.com';

    //smtp��¼������ ʹ�����ɵ���Ȩ�루�͸ղŽ��㱣������µ���Ȩ�룩
    $mail->Password = 'sqyofzbqlfkntbncl';

    //���÷����������ַ �������������ᵽ�ġ����������䡱
    $mail->From = '12345678@qq.com';

    //�ʼ������Ƿ�Ϊhtml���� ע��˴���һ������ ���������� true��false
    $mail->isHTML(true); 

    //�����ռ��������ַ �÷������������� ��һ������Ϊ�ռ��������ַ �ڶ�����Ϊ���õ�ַ���õ��ǳ� ��ͬ������ϵͳ���Զ����д���䶯 ����ڶ������������岻��
    $mail->addAddress($to,'lsgo����֪ͨ');

    //��Ӷ���ռ��� ���ε��÷�������
    // $mail->addAddress('xxx@163.com','lsgo����֪ͨ');

    //��Ӹ��ʼ�������
    $mail->Subject = $title;

    //����ʼ����� �Ϸ���isHTML���ó���true���������������html�ַ��� �磺ʹ��file_get_contents������ȡ���ص�html�ļ�
    $mail->Body = $content;

    //Ϊ���ʼ���Ӹ��� �÷���Ҳ���������� ��һ������Ϊ������ŵ�Ŀ¼�����Ŀ¼�������Ŀ¼���ɣ� �ڶ�����Ϊ���ʼ������иø���������
    // $mail->addAttachment('./d.jpg','mm.jpg');
    //ͬ���÷������Զ�ε��� �ϴ��������
    // $mail->addAttachment('./Jlib-1.1.0.js','Jlib.js');

    $status = $mail->send();

    //�򵥵��ж�����ʾ��Ϣ
    if($status) {
        return true;
    }else{
        return false;
    }
}