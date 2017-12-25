```
resources/views/
├── Guild #ギルド関連
│   ├── Party #パーティー関連
│   │   ├── Detail.blade.php #パーティー詳細表示
│   │   ├── Edit.blade.php   #パーティー編集
│   │   ├── Management #パーティー管理
│   │   │   ├── Applying.blade.php    #申請中パーティー
│   │   │   ├── Entry.blade.php       #参加中パーティー
│   │   │   ├── Holding.blade.php     #管理パーティー
│   │   │   └── _Navgation.blade.php  #管理のナビゲーションコンポーネント
│   │   └── Registration #パーティー登録
│   │       ├── Confirm.blade.php         #入力内容確認
│   │       ├── ProductionIdea.blade.php  #制作アイデア入力
│   │       └── Wanted.blade.php          #募集内容入力
│   ├── Search #検索関連
│   │   ├── GuildMember.blade.php #ギルドメンバー検索
│   │   └── Party.blade.php       #パーティー検索
│   └── Top.blade.php　#ギルドトップ
├── Shared #共有部分
│   ├── _Footer.blade.php #フッター
│   ├── _Header.blade.php #ヘッダー
│   └── _Menu.blade.php   #メニュー
├── SignUp #サインアップ
│   ├── AuthInfo.blade.php   #認証情報入力
│   ├── Profile.blade.php    #プロフィール入力
│   └── SchoolInfo.blade.php #学内情報入力
├── SognIn.blade.php #サインイン
├── Status  #ステータス関連
│   └── MyPage.blade.php #マイページ
└── Top.blade.php #OIC-RPGトップ
```