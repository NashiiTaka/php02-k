import OpenAI from "openai";
import express from "express";
import bodyParser from 'body-parser';

const app = express();
const port = 3000;

// urlencodedとjsonは別々に初期化する
app.use(bodyParser.urlencoded({
  extended: true
}));
app.use(bodyParser.json());

app.get('/', (req, res) => {
  res.send('Hello World!');
});

app.post('/chat', async (req, res) => {
  // ChatGPT Assistantへの接続テスト
  // https://platform.openai.com/docs/assistants/overview
  const openai = new OpenAI();

  // アシスタントを条件指定して取得する方法がわからなかったので、とりあえず0番目。
  // nameはあったので、name指定とかで取得はできるが、まぁ増えたらでいいかな。
  // const assistant = (await openai.beta.assistants.list()).data[0];


  let { message, thread_id } = req.body;
  // スレッドの作成
  if(!thread_id){
    const thread = await openai.beta.threads.create();
    thread_id = thread.id;
  }

  // メッセージの作成
  const newMessage = await openai.beta.threads.messages.create(
    thread_id,
    {
      role: "user",
      content: message
    }
  );

  // アシスタントの実行
  let run = await openai.beta.threads.runs.createAndPoll(
    thread_id,
    {
      assistant_id: "asst_HCwnSdMvqno8SX13Ya3Fjdjk",
    }
  );

  // 結果の取得
  if (run.status === 'completed') {
    const messages = await openai.beta.threads.messages.list(
      run.thread_id
    );
    const message = messages.data[0];
    //res.json(message.content[0].text);
    let json = message.content[0].text;
    if(typeof(json) === 'object'){
      json = json.value ? json.value : json;
    }
    if(typeof(json) === 'string'){
      json = JSON.parse(json);
    }
    json.thread_id = run.thread_id;
    res.send(JSON.stringify(json));
  } else {
    console.log(run.status);
  }
});

app.listen(port, () => {
  console.log(`Server is running at http://localhost:${port}`);
});