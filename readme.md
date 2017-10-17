# 環境構築手順

## 準備
以下のツールをダウンロードしてください

```
- git(https://git-for-windows.github.io/)
- composer(https://getcomposer.org/)
- Vagrant(https://www.vagrantup.com/)
- VirtualBox(https://www.virtualbox.org/)
```
### 確認方法
ターミナル(bashもしくはGitBash)で以下のコマンドを入力

```
git -v
composer -v
vagtant -v
```

##　構築

任意のディレクトで実行してください。
```
git clone https://github.com/44x1carbon/OIC-RPG.git
cd OIC-RPG
```

Laravelの設定
```
cp .env.example .env
composer install
php artisan key:generate
```

ssh鍵の準備
```
mkdir .ssh
ssh-keygen -f ./.ssh/id_rsa　-N ""
```

Vagrantの設定
```
vagrant box add laravel/homestead
```

## 確認

```
vagrant up
```

ブラウザーで```192.168.10.10```にアクセスし、Laravelの画面が見れれば環境構築完了
