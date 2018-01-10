<?php

namespace App\Helpers;

use Carbon\Carbon;
use Image;

class UploadsImageHelper extends UploadsHelper
{
    /**
     * Формирование названия файла из id пользователя и текущего времени
     * @param int $userId
     * @param  \Illuminate\Http\UploadedFile $image
     * @return string
     */
    private static function setNameFile($userId, $image)
    {
        return "{$userId}_" . Carbon::now()->format("d.m.Y_H:i:s") . ".{$image->getClientOriginalExtension()}";
    }

    /**
     * Сохранение изображение в временной папке
     * @param int $userId
     * @param \Illuminate\Http\UploadedFile $image
     * @return array
     */
    public static function saveInTmp($userId, $image)
    {
        self::removeTmpImages("{$userId}_*.*");

        $nameImage = self::setNameFile($userId, $image);
        Image::make($image)->save(public_path(self::PATH_TMP . $nameImage));

        @chmod(self::PATH_TMP . $nameImage, 0777);

        return [
            'url' => self::getUrlTmpImage($nameImage),
            'name' => $nameImage
        ];
    }

    /**
     * Объект изображения по названию файла
     * @param $nameFile
     * @return \Intervention\Image\Image|bool
     */
    public static function getTmpImage($nameFile)
    {
        $filePath = self::PATH_TMP . $nameFile;
        if(file_exists($filePath)){
            return Image::make($filePath);
        }

        return false;
    }

    /**
     * Ссылка на изображение
     * @param $nameFile
     * @return string
     */
    public static function getUrlTmpImage($nameFile)
    {
        return asset(self::PATH_TMP . $nameFile);
    }

    /**
     * Обрезка и сохранение фото профиля
     * @param int $userId
     * @param string $nameFile
     * @param string|null $oldLogo
     * @param int $width
     * @param int $height
     * @param int $x
     * @param int $y
     * @param int $resizeW
     * @param int $resizeH
     * @return bool
     */
    public static function cropUserLogo($userId, $nameFile, $oldLogo, $width, $height, $x, $y, $resizeW = 300, $resizeH = 300)
    {
        if($image = self::getTmpImage($nameFile)){
            $image->crop((int)$width, (int)$height, (int)$x, (int)$y);
            $image->resize((int)$resizeW, (int)$resizeH);
            $image->save(self::PATH_USER_LOGO . $nameFile);

            @chmod(self::PATH_USER_LOGO . $nameFile, 0777);

            self::removeTmpImages("{$userId}_*.*");
            self::removeUserLogo($oldLogo);
        }

        return (bool)$image;
    }

    /**
     * Получение ссылки на фото профиля
     * @param string $value
     * @param string $default
     * @return string
     */
    public static function getUserLogo($value, $default = '')
    {
        return (!empty($value) && file_exists(public_path() . "/" . self::PATH_USER_LOGO . $value))
            ? asset(self::PATH_USER_LOGO . $value)
            : asset($default);
    }

    public static function removeUserLogo($nameFile)
    {
        $pathImage = self::PATH_USER_LOGO . $nameFile;
        self::removeImage($pathImage);
    }

    public static function removeTmpImages($mask = '*.*')
    {
        $mask = self::PATH_TMP . $mask;
        $arrFiles = glob($mask);
        foreach ($arrFiles as $pathFile){
            self::removeImage($pathFile);
        }

        return $arrFiles;
    }

    public static function removeImage($pathFile)
    {
        if(file_exists($pathFile) && !is_dir($pathFile))
            unlink($pathFile);
    }
}